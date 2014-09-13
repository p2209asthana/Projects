% This function is the primary driver for homework 3 part 1
function hw3part1
close all;
clear all;
clc;
% we will experiment with a simple 2d dataset to visualize the decision
% boundaries learned by a MLP. Our goal is to study the changes to the
% decision boundary and the training error with respect to the following
% parameters
% - increasing overlap between the data points of the different classes
% - increasing the number of training iterations
% - increase the number of hidden layer neurons
% - see the effect of learning rate on the convergence of the network


% centroid for the three classes
c1=[1 1];
c2=[3 1];
c3=[2 3];

% standard deviation for the three classes
% "increase this quantity to increase the overlap between the classes"
% change this quantity to 0.75 when solving 1(f).
sd=0.2;

% number of data points per class
N=100;

rand('seed', 1);

% generate data points for the three classes
x1=randn(N,2)*sd+ones(N,1)*c1;
x2=randn(N,2)*sd+ones(N,1)*c2;
x3=randn(N,2)*sd+ones(N,1)*c3;

% generate the labels for the three classes in the binary notation
y1= repmat([1 0 0],N,1);
y2= repmat([0 1 0],N,1);
y3= repmat([0 0 1],N,1);

% creating the test data points
a1min = min([x1(:,1);x2(:,1);x3(:,1)]);
a1max = max([x1(:,1);x2(:,1);x3(:,1)]);

a2min = min([x1(:,2);x2(:,2);x3(:,2)]);
a2max = max([x1(:,2);x2(:,2);x3(:,2)]);

[a1 a2] = meshgrid(a1min:0.1:a1max, a2min:0.1:a2max);

testX=[a1(:) a2(:)];

% Experimenting with MLP

% number of epochs for training
nEpochs = 1000;

% learning rate
eta = 0.01;

% number of hidden layer units
H = 16;

% train the MLP using the generated sample dataset
[w, v, trainerror] = mlptrain([x1;x2;x3],[y1;y2;y3], H, eta, nEpochs);

% plot the train error againt the number of epochs
figure; plot(1:nEpochs, trainerror, 'b:', 'LineWidth', 2);
title(sprintf('Num Epochs = %d,Learning Rate = %.3f,Hidden Nodes=%d,standard deviation for overlap= %.3f ',nEpochs,eta,H,sd));

ydash = mlptest(testX, w, v);

[val idx] = max(ydash, [], 2);

label = reshape(idx, size(a1));

% ploting the approximate decision boundary
% -------------------------------------------

figure;
imagesc([a1min a1max], [a2min a2max], label), hold on,
set(gca, 'ydir', 'normal'),

% colormap for the classes:
% class 1 = light red, 2 = light green, 3 = light blue
cmap = [1 0.8 0.8; 0.9 1 0.9; 0.9 0.9 1];
colormap(cmap);

% plot the training data
plot(x1(:,1),x1(:,2),'r.', 'LineWidth', 2),
plot(x2(:,1),x2(:,2),'g+', 'LineWidth', 2),
plot(x3(:,1),x3(:,2),'bo', 'LineWidth', 2),
title(sprintf('Num Epochs = %d,Learning Rate = %.3f,Hidden Nodes=%d,standard deviation for overlap= %.3f ',nEpochs,eta,H,sd));
legend('Class 1', 'Class 2', 'Class 3', 'Location', 'NorthOutside', ...
    'Orientation', 'horizontal');

% viewing the decision surface for the three classes
% ydash1 = reshape(ydash(:,1), size(a1));
% ydash2 = reshape(ydash(:,2), size(a1));
% ydash3 = reshape(ydash(:,3), size(a1));
%
% figure;
% surf(a1, a2, ydash1, 'FaceColor', [1 0 0], 'FaceAlpha', 0.5), hold on,...
% surf(a1, a2, ydash2, 'FaceColor', [0 1 0], 'FaceAlpha', 0.5), hold on,...
% surf(a1, a2, ydash3, 'FaceColor', [0 0 1], 'FaceAlpha', 0.5);

function [w v trainerror] = mlptrain(X, Y, H, eta, nEpochs)
% X - training data of size NxD
% Y - training labels of size NxK
% H - the number of hiffe
% eta - the learning rate
% nEpochs - the number of training epochs
% define and initialize the neural network parameters

% number of training data points
N = size(X,1);
% number of inputs
D = size(X,2); % excluding the bias term
% number of outputs
K = size(Y,2);

% weights for the connections between input and hidden layer
% random values from the interval [-0.3 0.3]
% w is a Hx(D+1) matrix
w = -0.3+(0.6)*rand(H,(D+1));

% weights for the connections between input and hidden layer
% random values from the interval [-0.3 0.3]
% v is a Kx(H+1) matrix
v = -0.3+(0.6)*rand(K,(H+1));

% randomize the order in which the input data points are presented to the
% MLP
iporder = randperm(N);

% mlp training through stochastic gradient descent
trainerror =zeros(1,nEpochs);


for epoch = 1:nEpochs
    for n = 1:N
        
        % the current training point is X(iporder(n), :)
        % forward pass
        % --------------
        % input to hidden layer
        % calculate the output of the hidden layer units - z
        % ---------
        z = [1 zeros(1,H)];
        z(2:H+1)=w((1:H),1);%adding weight of bias
        z(2:H+1)=X(iporder(n),:)*w((1:H),(2:D+1))'+z(2:H+1);
        z(2:H+1)=1./(1+exp(-z(2:H+1)));
        % ---------
        % hidden to output layer
        % calculate the output of the output layer units - ydash
        % ---------
        Ydash=zeros(1,K);
        Ydash(:) = v(:,:)*z(:);
        Ydash(:) = exp(Ydash(:));%softmax
        Ydash=Ydash/sum(Ydash);
        % ---------
       
        
        % backward pass
        % ---------------
        % update the weights for the connections between hidden and
        % outlayer units
        v(:,:) = eta*(Y(iporder(n),:)-Ydash(1,:))'*z(1,:)+v(:,:) ;
        % ---------   
        

     
        % update the weights for the connections between the input and
        % hidden later units
        summ = (Y(iporder(n),:)-Ydash(1,:))*v(:,(2:H+1));
        w((1:H),1) = eta*(summ.*z(1,(2:H+1)).*(1-z(1,(2:H+1))))'+w((1:H),1);
        w((1:H),(2:D+1)) =eta*(summ.*z(1,(2:H+1)).*(1-z(1,(2:H+1))))'*X(iporder(n),(1:D))+ w((1:H),(2:D+1));
        
        % ---------
    end
    Ydash = mlptest(X, w, v);
    % compute the training error
    trainerror(epoch) = -sum(sum(log(Ydash).*Y));
    disp(sprintf('training error after epoch %d: %f\n',epoch,...
        trainerror(epoch)));
end
return;

function Ydash = mlptest(X, w, v)
% forward pass of the network

% number of inputs
N = size(X,1);
% number of outputs
K = size(v,1);
H = size(v,2)-1;
D = size(w,2)-1;
Ydash = zeros(N,K);
z = zeros(N,H+1);

% forward pass to estimate the outputs
% --------------------------------------
% input to hidden for all the data points
% calculate the output of the hidden layer units
% ---------
    z(:,(2:H+1))=ones(size(z,1),1)*w((1:H),1)';%adding weight of bias
    z(:,(2:H+1))=X(:,:)*w((1:H),(2:D+1))'+z(:,(2:H+1));
    z((2:H+1))=1./(1+exp(-z((2:H+1))));
    z(:,(2:H+1))=1./(1+exp(-z(:,(2:H+1))));
    % ---------
    % hidden to output layer
    % calculate the output of the output layer units - ydash
    % ---------
   
    Ydash(:,:) = exp(z(:,:)*v(:,:)');
    Ydash(:,:)=Ydash(:,:)./(sum(Ydash(:,:),2)*ones(1,size(Ydash,2)));        
return;