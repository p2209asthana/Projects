function [deltaT]=GetDeltaThreshold(B,F,lambda)
deltaT=sum(sum(abs(F-B)));
deltaT=deltaT*lambda/(size(F,1)*size(F,2));
end