#include<iostream>
#include<cmath>
using namespace std;
class vector4
{
//friend class matrix4;
//friend int main();
private:
double arr[4];
public:
vector4(){arr[0]=arr[1]=arr[2]=0;arr[3]=1;}
vector4(double X,double Y,double Z,double W)
{arr[0]=X;arr[1]=Y;arr[2]=Z;arr[3]=W;}
double& operator [](int i)
{
if((i<0)||(i>=4))cout<<"vector::out of bounds"<<endl;
return arr[i];
}
static vector4 normalize(vector4 vector)
{
vector4 temp;
float mag=sqrt(vector[0]*vector[0]+vector[1]*vector[1]+vector[2]*vector[2]);
temp[0]=vector[0]/mag;
temp[1]=vector[1]/mag;
temp[2]=vector[2]/mag;
temp[3]=1;
return temp;
}
vector4 operator + (vector4 vector)
{//overloads the + operator
//2 vectors can be added only if they are homogenized. thus first homogenize both vectors
vector4 first=homogenize(*this);
vector4 second= homogenize(vector);
vector4 temp;
temp[0]=first[0]+second[0];
temp[1]=first[1]+second[1];
temp[2]=first[2]+second[2];
temp[3]=1;
return temp;
}
vector4 operator - (vector4 vector)
{//overloads the - operator
//2 vectors can be subtracted only if they are homogenized. thus first homogenize both vectors
vector4 first=homogenize(*this);
vector4 second= homogenize(vector);
vector4 temp;
temp[0]=first[0]-second[0];
temp[1]=first[1]-second[1];
temp[2]=first[2]-second[2];
temp[3]=1;
return temp;
}
vector4 operator * (float f)
{
vector4 temp;
temp[0]=arr[0]*f;
temp[1]=arr[1]*f;
temp[2]=arr[2]*f;
temp[3]=1;
return temp;
}
vector4 operator = (vector4 vector)
{//oveloads the assignment operator
arr[0]=vector[0];
arr[1]=vector[1];
arr[2]=vector[2];
arr[3]=vector[3];
return *this;
}
vector4 operator += (vector4 vector)
{
arr[0]+=vector[0];
arr[1]+=vector[1];
arr[2]+=vector[2];
arr[3]+=vector[3];
return *this;
}
vector4 operator -=(vector4 vector)
{
arr[0]-=vector[0];
arr[1]-=vector[1];
arr[2]-=vector[2];
arr[3]-=vector[3];
return *this;
}
bool operator == (vector4 vector)
{//overloads the == operator
vector4 first=homogenize(*this);
vector4 second=homogenize(vector);
if(first[0]==second[0])if(first[1]==second[1])if(first[2]==second[2])return true;
return false;
}/*
float dot(vector4 vector)
{//retruns dot product of 2 vectors(1 argument).
vector4 first=homogenize(*this);
vector4 second=homogenize(vector);
float temp=0;
temp+=first[0]*second[0];
temp+=first[1]*second[1];
temp+=first[2]*second[2];
return temp;
}
static float dot(vector4 vector1,vector4 vector2)
{//returns dot product of 2 vecotors (2 argument)
return vector1.dot(vector2);
}*/
vector4 cross(vector4 vector)
{//retruns cross product of 2 vectors(1 argument).
vector4 first=homogenize(*this);
vector4 second=homogenize(vector);
vector4 temp;
temp[0]=first[1]*second[2]-first[2]*second[1];
temp[1]=first[2]*second[0]-first[0]*second[2];
temp[2]=first[0]*second[1]-first[1]*second[0];
temp[3]=1;
temp=normalize(temp);
return temp;
}
static vector4 cross(vector4 vector1,vector4 vector2)
{//retruns cross product of 2 vectors(2 argument).
return vector1.cross(vector2);
}
bool isHomogenious()
{
if(arr[3]==1)return true;
return false;
}
vector4 homogenize()
{//homogenize a given vector permanently
	if(!this->isHomogenious())
	{
	arr[0]=arr[0]/arr[3];arr[1]=arr[1]/arr[3];arr[2]=arr[2]/arr[3];arr[3]=1;
	}
return *this;
}
static vector4 homogenize(vector4 vector)
{//return the homogenized copy of a given vector without changing the vector
vector4 temp(vector[0],vector[1],vector[2],vector[3]);
if(!temp.isHomogenious())temp.homogenize();
return temp;
}
float magnitude()
{
float mag=sqrt(arr[0]*arr[0]+arr[1]*arr[1]+arr[2]*arr[2]);
return mag;

}

};

