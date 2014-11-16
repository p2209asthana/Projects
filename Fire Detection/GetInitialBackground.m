function [ backgroundframe ] = GetInitialBackground(obj,n)
backgroundframe=read(obj,n/2);
backgroundframe=rgb2gray(backgroundframe);
end
