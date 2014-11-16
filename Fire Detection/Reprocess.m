function [boolfirepixel] = Reprocess(boolfirepixel,a,b,c)
for i=1:a
boolfirepixel=medfilt2(boolfirepixel,[9 9]);
end
SE=strel('rectangle',[3 3]);
for i=1:b
boolfirepixel=imerode(boolfirepixel,SE);
end
for i=1:c
boolfirepixel=imdilate(boolfirepixel,SE);
end
end