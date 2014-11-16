function [isfire]=Detect(boolfirepixel)
isfire=0;
lT=350;
ut=450;
uut=1000;
c=bwconncomp(boolfirepixel);
maxm=max(cellfun(@numel,c.PixelIdxList))
if ~isempty(maxm) && maxm(1) > lT && maxm(1)<ut;
    isfire =1;
end
if ~isempty(maxm) && maxm(1)>ut && maxm(1)<uut;
    isfire =2;
end

end