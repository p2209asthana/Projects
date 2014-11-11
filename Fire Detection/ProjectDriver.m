function  ProjectDriver( obj )
%under assumption video is rgb not grayscale

beta=0.004;%update coefficient
T=1;%gray scale threshold
lambda=0.001;%inhibitory coefficient

n=obj.NumberOfFrames/10;
% get initial background
B_init=GetInitialBackground(obj,n);


B=B_init;
for i=(n/2+1):obj.NumberOfFrames
    rgbframe=read(obj,i);
    bwframe=rgb2gray(rgbframe);
    deltaT=GetDeltaThreshold(B,bwframe,lambda);
    T=T+deltaT;
    boolfirepixel=BackgroundSubtraction(B,bwframe,T);
    boolfirepixel=Reprocess(boolfirepixel);
%     newbwframe=double(bwframe).*double(boolfirepixel);
    newrgbframe= GetColored(boolfirepixel, rgbframe);
    newrgbframe= StaticProcessing(newrgbframe);
%     newframe=uint8(newframe);
%     imshow([read(obj,i) newframe]);
       imshow([rgbframe newrgbframe]);
    B=GetUpdatedBackground(B,bwframe,beta);
end

end

function [ backgroundframe ] = GetInitialBackground(obj,n)
backgroundframe=read(obj,n/2);
if size(backgroundframe,3)>1
    backgroundframe=rgb2gray(backgroundframe);
end
end

function [deltaT]=GetDeltaThreshold(B,F,lambda)
deltaT=sum(sum(abs(F-B)));
deltaT=deltaT*lambda/(size(F,1)*size(F,2));
end
function [ B_new] = GetUpdatedBackground(B_prev,F_prev,beta)
B_new= beta*B_prev+(1-beta)*F_prev;
end

function [D] =BackgroundSubtraction(B,F,T)
D=(abs(F-B))>T;
end

function [boolfirepixel] = Reprocess(boolfirepixel)
for i=1:1
boolfirepixel=medfilt2(boolfirepixel,[9 9]);
end
SE=strel('rectangle',[3 3]);
for i=1:1
boolfirepixel=imerode(boolfirepixel,SE);
end
for i=1:8
boolfirepixel=imdilate(boolfirepixel,SE);
end
end
function [newrgbframe]=GetColored(boolpixel,rgbframe)
newrgbframe=zeros(size(rgbframe));
newrgbframe(:,:,1)=double(rgbframe(:,:,1)).*double(boolpixel);
newrgbframe(:,:,2)=double(rgbframe(:,:,2)).*double(boolpixel);
newrgbframe(:,:,3)=double(rgbframe(:,:,3)).*double(boolpixel);
end
function [fire]= StaticProcessing(img)
Rt=115;
St=55;
I1=img(:,:,1)>=Rt;
I2=img(:,:,1)>=img(:,:,2)>=img(:,:,3);
S=min(img,[],3)./sum(img,3);
I3=S>=(255-img(:,:,1))*St/Rt;
I=I1 & I3;
fire=zeros(size(img));

fire(:,:,1)=img(:,:,1).*I;
fire(:,:,2)=img(:,:,2).*I;
fire(:,:,3)=img(:,:,3).*I;
end