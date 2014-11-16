function [newrgbframe]=GetColored(boolpixel,rgbframe)
newrgbframe=zeros(size(rgbframe));
newrgbframe(:,:,1)=im2double(rgbframe(:,:,1)).*im2double(boolpixel);
newrgbframe(:,:,2)=im2double(rgbframe(:,:,2)).*im2double(boolpixel);
newrgbframe(:,:,3)=im2double(rgbframe(:,:,3)).*im2double(boolpixel);
newrgbframe=im2uint8(newrgbframe);
end
