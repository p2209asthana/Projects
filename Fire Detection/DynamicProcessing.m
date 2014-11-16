function [I]=DynamicProcessing(prev,curr,next)
% prev curr next are grayscale frames
FTD=0.9;
FDt=abs(curr-prev);
FDt_1=abs(next-curr);
FDT=abs(FDt-FDt_1)./FDt;
I=FDT>=FTD;
end
