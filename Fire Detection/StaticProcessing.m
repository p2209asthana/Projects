function [I]= StaticProcessing(img)
img=double(img);
Rt=115;
St=55;
I1=img(:,:,1)>=115;
I2_1=img(:,:,1)>=img(:,:,2);
I2_2=img(:,:,2)>=img(:,:,3);
I2=I2_1 & I2_2;
S=1-3*min(min(img(:,:,1),img(:,:,2)),img(:,:,3))./sum(img,3);
I3=S>=(255-img(:,:,1))*St/Rt;
I=I1 & I2 & I3;
end