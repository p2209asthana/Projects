function  ProjectDriver( obj )
close all
%under assumption video is rgb not grayscale
firealert=imread('assets/images/firealert.jpg');
beta=0.4;%update coefficient -- 0<=beta<=1
T=1;%gray scale threshold
lambda=0.001;%inhibitory coefficient

n=uint8(obj.NumberOfFrames/10);
% get initial background
B_init=GetInitialBackground(obj,n);


B=B_init;
diff=2;
currbwframe=rgb2gray(read(obj,n/2+1-diff));
nextbwframe=rgb2gray(read(obj,n/2+1));
count=0;
for i=double((n/2+1)):diff:obj.NumberOfFrames-diff
    prevbwframe=currbwframe;
    currbwframe=nextbwframe;
    nextbwframe=rgb2gray(read(obj,i+diff));
    rgbframe=read(obj,i);%get rgb frame
    
    deltaT=GetDeltaThreshold(B,currbwframe,lambda);
    T=T+deltaT;%update threshold
    boolfirepixel=BackgroundSubtraction(B,currbwframe,T);
    boolfirepixel=Reprocess(boolfirepixel,1,1,8);
    boolfirepixel= boolfirepixel & StaticProcessing(rgbframe);
    boolfirepixel= boolfirepixel & StaticProcessing1(rgbframe);
    boolfirepixel=boolfirepixel & DynamicProcessing(prevbwframe,currbwframe,nextbwframe);
    boolfirepixel=Reprocess(boolfirepixel,2,0,0);
    isfire=Detect(boolfirepixel);
    
%     newrgbframe= GetColored(boolfirepixel, rgbframe);
%   imshow([rgbframe newrgbframe]); %uncomment to see progress of algorithm    
    imshow(rgbframe) ;
    if (count==1 && isfire==1) || isfire==2
        figure()
        imshow(firealert);
        display(strcat('Fire detected at frame# ',num2str(i)));
        break
    else
        if isfire==1
            count=1;
        else
            count=0;
        end
    end
    B=GetUpdatedBackground(B,currbwframe,beta);
end

end








