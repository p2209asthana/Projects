#include<iostream>
#include<stdio.h>
#include<GL/glut.h>
#include<GL/gl.h>
#include<GL/glu.h>
#include"func.h"
#define WIRE 0
#define SHOW_CURSOR 0
#define VIEW_ANGLE 60
#define FOG 0
using namespace std;	 
void Initialize()
{
for(int i=0;i<256;i++){
	state[i] = false;
}
GLfloat density = 0.05; //set the density to 0.3 which isacctually quite thick
GLfloat fogColor[4] = {174.0/255 ,178.0/255 ,187.0/255, 1.0}; //set the forcolor to grey
if(FOG)
glEnable (GL_FOG); //enable the fog
glFogi (GL_FOG_MODE, GL_EXP); //set the fog mode to GL_EXP2
glFogfv (GL_FOG_COLOR, fogColor); //set the fog color toour color chosen above
glFogf (GL_FOG_DENSITY, density); //set the density to thevalue above
//glHint (GL_FOG_HINT, GL_NICEST); // set the fog to look thenicest, may slow down on older cards
glEnable(GL_DEPTH_TEST);
glMatrixMode(GL_PROJECTION);
glLoadIdentity();
gluLookAt(1,2,-1,1,2,-2,0,1,0);
gluPerspective(VIEW_ANGLE,glutGet(GLUT_WINDOW_WIDTH)*1.0/glutGet(GLUT_WINDOW_HEIGHT),1,100);
envInitialize();

}
int main(int argc, char*argv[])
{
	glutInit(&argc,argv);
	glutInitDisplayMode(GLUT_DOUBLE | GLUT_RGB|GLUT_DEPTH);
	glutInitWindowPosition(0,0);
	glutInitWindowSize(800,800);
	glutCreateWindow("arcade");
	Initialize();
	glutDisplayFunc(Draw);
	glutIdleFunc(Draw);
	glutReshapeFunc (redraw);
	glutPassiveMotionFunc(motion);
	glutKeyboardFunc(keyPress);
	glutSpecialFunc(specialkey);
	glutKeyboardUpFunc(keyUp);
	if(!SHOW_CURSOR)glutSetCursor(GLUT_CURSOR_NONE);
	int midx = glutGet(GLUT_WINDOW_WIDTH)/2;
	int midy = glutGet(GLUT_WINDOW_HEIGHT)/2;
	glutWarpPointer(midx,midy);
	glutFullScreen();
	glutMainLoop();
	return 0;
}
