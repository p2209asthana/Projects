function [fire]=StaticProcessing1(img)

img=rgb2ycbcr(im2double(img));
Y=img(:,:,1);
Cb=img(:,:,2);
Cr=img(:,:,3);
Ymean=mean(mean(Y));
Cbmean=mean(mean(Cb));
Crmean=mean(mean(Cr));

I1=Y>Cb;
I2=Cr>Cb;
I3=Y>Ymean;
I4=Cb<Cbmean;
I5=Cr>Crmean;

Tau=0.05020;%depends on what is true positive rate and false positie rate
I6=abs(Cb-Cr)>Tau;

% Cr7=Cr.^7;
% Cr6=Cr.^6;
Cr5=Cr.^5;
Cr4=Cr.^4;
Cr3=Cr.^3;
Cr2=Cr.^2;
% fu=-0.00000000026*Cr7+0.00000033*Cr6-0.00017*Cr5+0.0516*Cr4-9.1*Cr3-56000*Cr+14000;
fl=-6.77*10^-8*Cr5+5.5*10^-5*Cr4-1.76*10^-2*Cr3+2.78*Cr2-2.15*100*Cr+6.62*1000;
fd=1.81*10^-4*Cr4-0.102*Cr3+21.7*Cr2-2.05*1000*Cr+7.29*10000;

% I7=Cb>=fu;
I8=Cb<fd;
I9=Cb<fl;

I=I1 & I2 & I3 & I4 & I5 & I6  & I8 & I9 ;
fire=I;
end
