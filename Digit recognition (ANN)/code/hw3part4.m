function hw3part4
clc
clear all
close all

load('mnist.mat');

tridx = [];
validx = [];
tsidx = [];

% fraction of the data to be used for validation and test.
valfrac = 0.2;
tsfrac = 0.2;

for k = 1:size(label,2)
    % ifnd the indices of the data points of a particular class
    r = find(label(:,k) == 1);
    % number of data points belonging tot eh k^th class
    nclass = length(r);
    % randomize the indices for the k^{th} class data points
    ridx = randperm(nclass);
    % use the first nclass*tsfrac indices as the test data points
    temptsidx = r(ridx(1:nclass*tsfrac));
    % use the next nclass*valfrac indices as the validation set
    tempvalidx = r(ridx(nclass*tsfrac+1:nclass*tsfrac+1+nclass*valfrac));
    % use the remaining indices as training points
    temptridx = setdiff(r, [temptsidx; tempvalidx]);    
    % append the indices to the cumulative variable
    tridx = [tridx temptridx];
    tsidx = [tsidx temptsidx];
    validx = [validx tempvalidx];
end

% separate the train, validation and test datasets
trX = data(tridx,:);
trY = label(tridx,:);

valX = data(validx,:);
valY = label(validx,:);

tsX = data(tsidx,:);
tsY = label(tsidx,:);


% size of the training data
[N, D] = size(trX);
% number of epochs
nEpochs = 100;
% learning rate
eta = 0.01;
% number of hidden layer units
H = 500;
% number of output layer units
K = 10;

% randomize the weights from input to hidden layer units
% 'TO DO'
w = -0.3+(0.6)*rand(H,(D+1));
% randomize the weights from hidden to output layer units
% 'TO DO'
v = -0.3+(0.6)*rand(K,(H+1));

% let us create the indices for the batches as it cleans up script later
% size of the training batches
batchsize = 25;
% number of batches
nBatches = floor(N/batchsize);
% create the indices of the data points used for each batch
% i^th row in batchindices will give th eindices for the data points for
% the i^th batch
batchindices = reshape([1:batchsize*nBatches]',batchsize, nBatches);
batchindices = batchindices';
% if there are any data points left out, add them at the end padding with
% some other indices from the previous batch
if N - batchsize*nBatches >0
    batchindices(end+1,:)=batchindices(end,:);
    batchindices(end,1:(N - batchsize*nBatches)) = [batchsize*nBatches+1: N];
end

% randomize the order of the training data
ridx = randperm(N);
trX = trX(ridx,:);
trY= trY(ridx,:);

trErr=zeros(1,nEpochs);
valErr=zeros(1,nEpochs);
for epoch = 1:nEpochs
     epoch 
    for batch = 1:nBatches
        % Call the forward pass function to obtain the outputs
        % 'TO DO'
        x=trX(batchindices(batch,:),:);
        y=trY(batchindices(batch,:),:);
        [z Ydash] = forwardpass(x, w, v);
        % Call the gradient function to obtain the required gradient updates
        % 'TO DO'
        [deltaw ,deltav] = computegradient(x, y, w, v, z, Ydash);
        % update the weights of the two sets of weights
        % 'TO DO' 
        w = w + eta*deltaw/batchsize;
        v = v + eta*deltav/batchsize;
        
    end
    % at the end of epoch compute the classification error on training
    % and validation dataset
    % 'TO DO'
    [~ ,trYdash] = forwardpass(trX, w, v);
    trErr(epoch)=classerror(trY, makeboolean(trYdash));
    [~ ,valYdash] = forwardpass(valX, w, v);
    valErr(epoch)=classerror(valY, makeboolean(valYdash));
end

% compute the classification error on the test set
% 'TO DO'
[~ ,tsYdash] = forwardpass(tsX, w, v);

classerror(tsY, makeboolean(tsYdash))


% plot atmost 2 misclassified examples for each digit using the displayData
% function
% 'TO DO'
misclassified=zeros(20,size(tsX,2));
miscount=0;
count=zeros(1,10);
for n =1:size(tsX,1)
err=classerror(tsY(n,:),makeboolean(tsYdash(n,:)));
if (err>0)
    pos=find(tsY(n,:),1);
    if(count(pos)<2)
        miscount=miscount+1;
        count(pos)=count(pos)+1;
        misclassified(miscount,:)=tsX(n,:);
    end
end

end
displayData(misclassified(1:miscount,:));
figure();
plot((1:100),trErr,'r',(1:100),valErr,'b');
legend('Training Error', 'Testing Error');
xlabel('num Epochs');
ylabel('Classification Error');

function [Y]=makeboolean(Y)
temp=max(Y');
size(temp);
for i=1:size(Y,1)
    Y(i,:)=Y(i,:)==temp(1,i);
end
return    
function [z Ydash] = forwardpass(X, w, v)
% this function performs the forward pass on a set of data points in the
% variable X and returns the output of the hidden layer units- z and the
% output layer units ydash
% 'TO DO'
N = size(X,1);
D = size(w,2)-1;
H = size(v,2)-1;
K = size(v,1);
Ydash = zeros(N,K);

z = zeros(N,H+1);

z(:,1) = 1;
z(:,(2:H+1))=ones(size(z,1),1)*w((1:H),1)';%adding weight of bias
z(:,(2:H+1))=X(:,:)*w((1:H),(2:D+1))'+z(:,(2:H+1));
t1=exp(z(:,(2:H+1)));
t2=exp(-z(:,(2:H+1)));
z(:,(2:H+1))=(t1-t2)./(t1+t2);  
% ---------
% hidden to output layer
% calculate the output of the output layer units - ydash
% ---------
Ydash(:,:) = exp(z(:,:)*v(:,:)');
Ydash(:,:)=Ydash(:,:)./(sum(Ydash(:,:),2)*ones(1,size(Ydash,2)));        
return;

function [deltaw deltav] = computegradient(X, Y, w, v, z, Ydash)
% this function computes the gradient of the error function with resepct to
% the weights
% 'TO DO'

% N = size(X,1);
D = size(w,2)-1;
H = size(v,2)-1;
% K = size(v,1);

deltav = zeros(size(v));
deltaw = zeros(size(w));

deltav(:,:) = (Y(:,:)-Ydash(:,:))'*z(:,:);   
summ = (Y(:,:)-Ydash(:,:))*v(:,(2:H+1));
deltaw((1:H),1) = (summ.*(1-z(:,(2:H+1)).^2))'*ones(size(X,1),1);
deltaw((1:H),(2:D+1)) =(summ.*(1-z(:,(2:H+1)).^2))'*X(:,(1:D));
return;

function error = classerror(y, ydash)
% this function computes the classification error given the actual output y
% and the predicted output ydash
error = sum(sum(abs(y-ydash), 2)>0);
return;

function [h, display_array] = displayData(X)
% DO NOT CHANGE ANYTHING HERE
%DISPLAYDATA Display 2D data in a nice grid
%   [h, display_array] = DISPLAYDATA(X, example_width) displays 2D data
%   stored in X in a nice grid. It returns the figure handle h and the 
%   displayed array if requested.
%   example to plot the data provided by Andrew Ng.

% Set example_width automatically if not passed in
if ~exist('example_width', 'var') || isempty(example_width) 
	example_width = round(sqrt(size(X, 2)));
end

% Gray Image
colormap(gray);

% Compute rows, cols
[m n] = size(X);
example_height = (n / example_width);

% Compute number of items to display
display_rows = floor(sqrt(m));
display_cols = ceil(m / display_rows);

% Between images padding
pad = 1;

% Setup blank display
display_array = - ones(pad + display_rows * (example_height + pad), ...
                       pad + display_cols * (example_width + pad));

% Copy each example into a patch on the display array
curr_ex = 1;
for j = 1:display_rows
	for i = 1:display_cols
		if curr_ex > m, 
			break; 
		end
		% Copy the patch
		
		% Get the max value of the patch
		max_val = max(abs(X(curr_ex, :)));
		display_array(pad + (j - 1) * (example_height + pad) + (1:example_height), ...
		              pad + (i - 1) * (example_width + pad) + (1:example_width)) = ...
						reshape(X(curr_ex, :), example_height, example_width) / max_val;
		curr_ex = curr_ex + 1;
	end
	if curr_ex > m, 
		break; 
	end
end

% Display Image
h = imagesc(display_array, [-1 1]);

% Do not show axis
axis image off

drawnow;
return;
