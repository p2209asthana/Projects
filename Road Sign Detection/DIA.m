function [ sceneImage ] = dia( sceneImage )

sceneImage = im2double(sceneImage);

[a,b,c]=size(sceneImage);
Y=zeros(a,b);
Cr=zeros(a,b);
Cb=zeros(a,b);

se=ones(3,3);
sr=[1 1 1;1 0 1;1 1 1];

bright=0;

for i= 1:a,
    for j = 1:b,
        Y(i,j)=0.299*sceneImage(i,j,1)+0.587*sceneImage(i,j,2)+0.114*sceneImage(i,j,3);
        Y(i,j)=Y(i,j)>0.56;
    end
end

for i =1:a,
    for j =1:b,
        bright = bright+Y(i,j);
    end
end

bright=bright/(a*b);

for i=1:a,
    for j=1:b,
        Cr(i,j)=0.5*sceneImage(i,j,1)-0.419*sceneImage(i,j,2)-0.08*sceneImage(i,j,3);
        if bright < 0.4,
            Cr(i,j)=Cr(i,j)>0.12;
        elseif bright >0.4
            Cr(i,j)=Cr(i,j)>0.20;
        elseif bright > 0.8
            Cr(i,j) =Cr(i,j)>0.50;
        end
        Cb(i,j)=0.5*sceneImage(i,j,1)-0.169*sceneImage(i,j,2)-0.331*sceneImage(i,j,3);
    end
end

im3 = medfilt2(Cr,[3,3]);

im3=imdilate(im3,se);
for i =1:50,
    im3=imdilate(im3,se);
end

im3=imerode(im3,sr);
for i=1:55,
    im3=imerode(im3,sr);
end

im4=zeros(a ,b);

for i=1:a,
    for j=1:b,
        im4(i,j)=im3(i,j)*Y(i,j);
    end
end

im4=medfilt2(im4,[5,5]);

%figure;
%imshow(Y);
%figure;
%imshow(im3);  %Pure white board

%----------------Bounding sign board with a rectangle----------------------
minc=b;
maxc=1;
minr=a;
maxr=1;

for i=1:a,
    for j=1:b,
        if im3(i,j)==1
            if minc > j
                minc=j;
            end
            if minr > i
                minr=i;
            end
            if maxr < i
                maxr=i;
            end
            if maxc < j
                maxc=j;
            end
        end
    end
end
%--------------------------------------------------------------------------

%---------------Drawing boundaries in actual image-------------------------
p=[minr minc];
q=[maxr maxc];

for i=minc:maxc,
    for j = minr:minr+uint32(a/100)+1,
        sceneImage(j,i)=1;
    end
end
for i=minc:maxc,
    for j = maxr-uint32(a/100)+1:maxr,
        sceneImage(j,i)=1;
    end
end
for i=minr:maxr,
    for j =minc:minc+uint32(b/100)+1,
        sceneImage(i,j)=1;
    end
end
for i=minr:maxr,
    for j =maxc-uint32(b/100)+1:maxc,
        sceneImage(i,j)=1;
    end
end
%--------------------------------------------------------------------------

%------------------Cutoff 1st 20percent image------------------------------

for i=minr:minr+uint32(0.2*(maxr-minr+1)),
    for j=minc:maxc,
        im4(i,j)=0;
    end
end

for i=maxr:-1:maxr-uint32(0.2*(maxr-minr+1)),
    for j=minc:maxc,
        im4(i,j)=0;
    end
end

for i=minc:minc+uint32(0.05*(maxc-minc+1)),
    for j=minr:maxr,
        im4(j,i)=0;
    end
end

for i=maxc:-1:maxc-uint32(0.05*(maxc-minc+1)),
    for j=minr:maxr,
        im4(j,i)=0;
    end
end

%--------------------------------------------------------------------------

%-----------------Bounding rectangle for Text in sign board----------------
minc4=b;
maxc4=1;
minr4=a;
maxr4=1;

for i=1:a,
    for j=1:b,
        if im4(i,j)==1
            if minc4 > j
                minc4=j;
            end
            if minr4 > i
                minr4=i;
            end
            if maxr4 < i
                maxr4=i;
            end
            if maxc4 < j
                maxc4=j;
            end
        end
    end
end
%--------------------------------------------------------------------------

%----------------Draw bounding rectangle for text in sign board------------
for i=minc4:maxc4,
    for j = minr4:minr4+uint32(a/100)+1,
        sceneImage(j,i)=1;
    end
end
for i=minc4:maxc4,
    for j = maxr4-uint32(a/100)+1:maxr4,
        sceneImage(j,i)=1;
    end
end
for i=minr4:maxr4,
    for j =minc4:minc4+uint32(b/100)+1,
        sceneImage(i,j)=1;
    end
end
for i=minr4:maxr4,
    for j =maxc4-uint32(b/100)+1:maxc4,
        sceneImage(i,j)=1;
    end
end
%--------------------------------------------------------------------------

%figure;
%imshow(im4);

%-------------To form accurate boundary for sign boards--------------------
pts=zeros(maxr-minr+1,maxc-minc+1);

for i=minr:maxr,
    for j=minc:maxc,
        if Cr(i,j)==1
            sceneImage(i,j,1)=0;
            sceneImage(i,j,2)=0;
            sceneImage(i,j,3)=0;
            break;
        end
    end
end

pts=zeros(maxr-minr+1);

for i=minr:maxr,
    for j=maxc:-1:minc,
        if Cr(i,j)==1
            sceneImage(i,j,1)=0;
            sceneImage(i,j,2)=0;
            sceneImage(i,j,3)=0;
            break;
        end
    end
end
%--------------------------------------------------------------------------

hscene = maxr-minr+1;
wscene = maxc-minc+1;

himg = maxr4-minr4+1;
wimg = maxc4-minc4+1;

hratio = himg/hscene;
wratio = wimg/wscene;

f=[hratio, wratio];
error = 0.5*((hratio-0.33)*(hratio-0.33)+(wratio-0.81)*(wratio-0.81));
error2= 0.5*((hratio-0.60)*(hratio-0.60)+(wratio-0.82)*(wratio-0.82));

figure;
imshow(sceneImage);
if error < 0.0140
    title('This is stop sign');
elseif error2 <0.0150
    title('This is a Do Not Enter Sign');
else
    title('Unknown sign board');
end

end

