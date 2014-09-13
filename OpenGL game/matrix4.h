#include<iostream>
#include<cmath>
#define matsize 4
#define _USE_MATH_DEFINES
using namespace std;


class matrix4
{
private:
double**arr;
public:
matrix4()
{
arr= new double*[matsize];
for(int i=0;i<matsize;i++)
arr[i]=new double[matsize];
for(int i=0;i<matsize;i++)for(int j=0;j<matsize;j++)arr[i][j]=0;
}
double& operator ()(int i,int j)
{
if((i<0)||(j<0)||(i>=matsize)||(j>=matsize))
{cout<<"Out of bounds exception"<<endl; }
return arr[i][j];
}
matrix4 operator *(matrix4 matrix)
{
matrix4 temp;
for(int i=0;i<matsize;i++)
for(int j=0;j<matsize;j++)
for(int k=0;k<matsize;k++)
temp(i,j)+=(*this)(i,k)*matrix(k,j);
return temp;
}
vector4 operator *(vector4 vector)
{
vector4 temp;
for(int i=0;i<4;i++)
for(int j=0;j<4;j++)
temp[i]+=(*this)(i,j)*vector[j];
//temp=vector4::normalize(temp);
return temp;
}
static matrix4 getIdentity()
{
matrix4 temp;
temp(0,0)=temp(1,1)=temp(2,2)=temp(3,3)=1;
return temp;
}
static matrix4 getTrans(double dx,double dy,double dz)
{
matrix4 temp;
temp(0,0)=temp(1,1)=temp(2,2)=temp(3,3)=1;
temp(0,3)=dx;
temp(1,3)=dy;
temp(2,3)=dz;
return temp;
}
static matrix4 getScale(double sx,double sy,double sz)
{
matrix4 temp;
temp(0,0)=sx;
temp(1,1)=sy;
temp(2,2)=sz;
temp(3,3)=1;
return temp;
}
static matrix4 getRotateX(double angle)
{
matrix4 temp;
temp(0,0)=temp(3,3)=1;
temp(1,1)=temp(2,2)=cos(angle);
temp(1,2)=-1*sin(angle);
temp(2,1)=sin(angle);	
return temp;
}
static matrix4 getRotateY(double angle)
{
matrix4 temp;
temp(1,1)=temp(3,3)=1;
temp(0,0)=temp(2,2)=cos(angle);
temp(0,2)=-1*sin(angle);
temp(2,0)=sin(angle);	
return temp;
}
static matrix4 getRotateZ(double angle)
{
matrix4 temp;
temp(2,2)=temp(3,3)=1;
temp(0,0)=temp(1,1)=cos(angle);
temp(0,1)=-1*sin(angle);
temp(1,0)=sin(angle);	
return temp;
}
static matrix4 getRotateArb(vector4 axis,double angle)
{
axis=vector4::normalize(axis);
matrix4 temp;
double COS,SIN;
SIN=sin(angle);
COS=cos(angle);
double ux=axis[0];
double uy=axis[1];
double uz=axis[2];
temp(0,0)=COS+ux*ux*(1-COS);
temp(0,1)=ux*uy*(1-COS)-uz*SIN;
temp(0,2)=ux*uz*(1-COS)+uy*SIN;

temp(1,0)=uy*ux*(1-COS)+uz*SIN;
temp(1,1)=COS+uy*uy*(1-COS);
temp(1,2)=uy*uz*(1-COS)-ux*SIN;

temp(2,0)=uz*ux*(1-COS)-uy*SIN;
temp(2,1)=uz*uy*(1-COS)+ux*SIN;
temp(2,2)=COS+uz*uz*(1-COS);
temp(3,3)=1;
return temp;
}
};

