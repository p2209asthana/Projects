#include"vector4.h"
#define DEF_COL_R 1
#define DEF_COL_G 1
#define DEF_COL_B 0.3
#define DEF_COL_A 0.5
#define HALF_SIDE 2
//--------
#define checkImageWidth 64
#define checkImageHeight 64
static GLubyte checkImage[checkImageHeight][checkImageWidth][4];//type is glubyte a single color component(r/g/b/a) is of size one byte
static GLuint texName;
//static GLuint texName;


void init_image(void)
{    
   glClearColor (0.0, 0.0, 0.0, 0.0);
   glShadeModel(GL_FLAT);//specifies shading model
   glEnable(GL_DEPTH_TEST);
	
}
//------------------------------------------



//------


int NUM_ROWS;
int NUM_COLOUMNS;

struct face
{
int a,b,c,d;
};
face FACE_ARR[6];



void BLOCKS_INIT()
{
FACE_ARR[0].a=0;FACE_ARR[0].b=1;FACE_ARR[0].c=2;FACE_ARR[0].d=3;//front face
FACE_ARR[1].a=4;FACE_ARR[1].b=7;FACE_ARR[1].c=6;FACE_ARR[1].d=5;//back face
FACE_ARR[2].a=4;FACE_ARR[2].b=3;FACE_ARR[2].c=2;FACE_ARR[2].d=7;//top face
FACE_ARR[3].a=1;FACE_ARR[3].b=0;FACE_ARR[3].c=5;FACE_ARR[3].d=6;//bottom face
FACE_ARR[4].a=0;FACE_ARR[4].b=3;FACE_ARR[4].c=4;FACE_ARR[4].d=5;//left face
FACE_ARR[5].a=1;FACE_ARR[5].b=6;FACE_ARR[5].c=7;FACE_ARR[5].d=2;//right face

init_image();
}



class block
{
private:
float centreX;
float centreY;
float centreZ;
//colors defined on 0-1 scale
float colorR;
float colorG;
float colorB;
float colorA;
vector4 vertex_arr[8];
void fillvertexarray()
{
vertex_arr[0]=vector4(centreX-HALF_SIDE,centreY-HALF_SIDE,centreZ+HALF_SIDE,1);
vertex_arr[1]=vector4(centreX+HALF_SIDE,centreY-HALF_SIDE,centreZ+HALF_SIDE,1);
vertex_arr[2]=vector4(centreX+HALF_SIDE,centreY+HALF_SIDE,centreZ+HALF_SIDE,1);
vertex_arr[3]=vector4(centreX-HALF_SIDE,centreY+HALF_SIDE,centreZ+HALF_SIDE,1);
vertex_arr[4]=vector4(centreX-HALF_SIDE,centreY+HALF_SIDE,centreZ-HALF_SIDE,1);
vertex_arr[5]=vector4(centreX-HALF_SIDE,centreY-HALF_SIDE,centreZ-HALF_SIDE,1);
vertex_arr[6]=vector4(centreX+HALF_SIDE,centreY-HALF_SIDE,centreZ-HALF_SIDE,1);
vertex_arr[7]=vector4(centreX+HALF_SIDE,centreY+HALF_SIDE,centreZ-HALF_SIDE,1);
}
public:
block()
{}
block(float x, float y, float z)
{
centreX=x;
centreY=y;
centreZ=z;
colorR=DEF_COL_R;
colorG=DEF_COL_G;
colorB=DEF_COL_B;
colorA=DEF_COL_A;
fillvertexarray();
}
block(float x, float y, float z, float r, float g, float b, float a)
{
centreX=x;
centreY=y;
centreZ=z;
colorR=r;
colorG=g;
colorB=b;
colorA=a;
fillvertexarray();
}
void drawblock()
{
for(int i=0;i<6;i++)
{
	glEnable(GL_TEXTURE_2D);
   glTexEnvf(GL_TEXTURE_ENV, GL_TEXTURE_ENV_MODE, GL_DECAL);
   glBindTexture(GL_TEXTURE_2D, texName);

glBegin(GL_QUADS);
glColor4f(colorR,colorG,colorB,colorA);glTexCoord2f(0.0, 0.0);
glVertex3f(vertex_arr[FACE_ARR[i].a][0],vertex_arr[FACE_ARR[i].a][1],vertex_arr[FACE_ARR[i].a][2]);glTexCoord2f(0.0, 1.0);
glVertex3f(vertex_arr[FACE_ARR[i].b][0],vertex_arr[FACE_ARR[i].b][1],vertex_arr[FACE_ARR[i].b][2]);glTexCoord2f(1.0, 1.0);
glVertex3f(vertex_arr[FACE_ARR[i].c][0],vertex_arr[FACE_ARR[i].c][1],vertex_arr[FACE_ARR[i].c][2]);glTexCoord2f(1.0, 0.0);
glVertex3f(vertex_arr[FACE_ARR[i].d][0],vertex_arr[FACE_ARR[i].d][1],vertex_arr[FACE_ARR[i].d][2]);
glEnd();


glDisable(GL_TEXTURE_2D);

/*
glColor4f(0,0,0,1);
glBegin(GL_LINES);
	glVertex3f(vertex_arr[FACE_ARR[i].a][0],vertex_arr[FACE_ARR[i].a][1],vertex_arr[FACE_ARR[i].a][2]);
	glVertex3f(vertex_arr[FACE_ARR[i].b][0],vertex_arr[FACE_ARR[i].b][1],vertex_arr[FACE_ARR[i].b][2]);
glEnd();
glBegin(GL_LINES);
	glVertex3f(vertex_arr[FACE_ARR[i].b][0],vertex_arr[FACE_ARR[i].b][1],vertex_arr[FACE_ARR[i].b][2]);
	glVertex3f(vertex_arr[FACE_ARR[i].c][0],vertex_arr[FACE_ARR[i].c][1],vertex_arr[FACE_ARR[i].c][2]);
glEnd();
glBegin(GL_LINES);
	glVertex3f(vertex_arr[FACE_ARR[i].c][0],vertex_arr[FACE_ARR[i].c][1],vertex_arr[FACE_ARR[i].c][2]);
	glVertex3f(vertex_arr[FACE_ARR[i].d][0],vertex_arr[FACE_ARR[i].d][1],vertex_arr[FACE_ARR[i].d][2]);
glEnd();
glBegin(GL_LINES);
	glVertex3f(vertex_arr[FACE_ARR[i].d][0],vertex_arr[FACE_ARR[i].d][1],vertex_arr[FACE_ARR[i].d][2]);
	glVertex3f(vertex_arr[FACE_ARR[i].a][0],vertex_arr[FACE_ARR[i].a][1],vertex_arr[FACE_ARR[i].a][2]);
glEnd();

*/
}
//glFlush();
}

};

