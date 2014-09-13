#include<iostream>
using namespace std;
#include<GL/glut.h>
#include<math.h>
#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include"env.h"
#include"matrix4.h"
#define SPD 1.0
#define FSPD 2
#define JUMP_HT 0.1

GLuint l;
double camX=1,camY=HALF_SIDE,camZ=-1;
double camHorizontalRot = 40;
double camVerticalRot = 0;
double lastPosX = 0;
double lastPosY = 0;
float pi = 3.142857;

double step = 10;
Mix_Music *START_S,*ENDING_S;
bool jump=0;
int jump_count=0; 
int jump_dir=0;
char jump_char='\0';
bool gravityMode=1;
bool state[256];
bool end;
void limit(double &camX,double &camY,double &camZ,double &camVerticalRot,double&camHorizontalRot){
	if(jump==0)
	camY=HALF_SIDE;
	if(camY<HALF_SIDE)camY=HALF_SIDE;
	
	if(camVerticalRot>40)camVerticalRot=40;//prevents camera from completely turning in downward direction
	if(camVerticalRot<-65)camVerticalRot=-65;//prevents camera from competely turning in upward direction
	
	float shift=1;
	if(camX<left_lt+shift){
		camX=left_lt+shift;
	}
	if(camX>right_lt-shift){
		camX=right_lt-shift;
	}
	if(camZ<back_lt+shift){
		camZ=back_lt+shift;
	}
	if(camZ>front_lt-shift){
		camZ=front_lt-shift;
	}
}
bool playjumpmusic()
{
if( Mix_PlayChannel( -1, JUMP_S, 0 ) == -1 )
return 1;          
}

void checkcollision()
{
double x=camX;
double z=-camZ;
float err=0.9;
int qx=x/gap;
int qz=z/gap;
qx+=1;
qz+=1;

bool a=(x>=qx*gap-2*HALF_SIDE-err)&&(x<=qx*gap+err);
bool b=(z>=qz*gap-2*HALF_SIDE-err)&&(z<=qz*gap+err); 

if(a&&b)
{
	if(state['s']){
		camY -= SPD*sin(camVerticalRot*pi/180);
		camX += SPD*sin(camHorizontalRot*pi/180);
		camZ -= SPD*cos(camHorizontalRot*pi/180);
	}
	else if(state['S']){	
		camY -= FSPD*sin(camVerticalRot*pi/180); ;
		camX += FSPD*sin(camHorizontalRot*pi/180);
		camZ -= FSPD*cos(camHorizontalRot*pi/180);
	}
	else if(state['w']){	
		camY += SPD*sin(camVerticalRot*pi/180); ;
		camX -= SPD*sin(camHorizontalRot*pi/180);
		camZ += SPD*cos(camHorizontalRot*pi/180);
	}
	else if(state['W']){	
		camY += FSPD*sin(camVerticalRot*pi/180); ;
		camX -= FSPD*sin(camHorizontalRot*pi/180);
		camZ += FSPD*cos(camHorizontalRot*pi/180);
	}
	else if(state['d']){	
		camX -= (SPD/2)*cos(camHorizontalRot*pi/180); ;
		camZ -= (SPD/2)*sin(camHorizontalRot*pi/180);
		
	}
	else if(state['D']){	
		camX -= (SPD/2)*cos(camHorizontalRot*pi/180); ;
		camZ -= (SPD/2)*sin(camHorizontalRot*pi/180);

	}
	else if(state['a']){	
		camX += (SPD/2)*cos(camHorizontalRot*pi/180); ;
		camZ += (SPD/2)*sin(camHorizontalRot*pi/180);

	}
	else if(state['A']){	
		camX += (SPD/2)*cos(camHorizontalRot*pi/180); ;
		camZ += (SPD/2)*sin(camHorizontalRot*pi/180);
	}
}
}
bool tri=0;
void specialkey(int key,int x,int y)
{
	switch(key)
	{		
	case GLUT_KEY_UP:
	{	tri=0;
		break;
	}
	case GLUT_KEY_DOWN:
	{
		tri=1;
		break;
	}

	}

}
int count=0;
char score_str[62];
char msg[20]="Coins: ";
char msg1[20];
void display()
{	sprintf(msg1, "%d", NUM_COIN);
	sprintf(score_str, "%d", score);
	glColor4f(1.0f, 1.0f, 1.0f, 1.0f);
	glRasterPos3f(0.75, 0.5,-1);
	for(int i=0;i<strlen(msg);i++)
		glutBitmapCharacter(GLUT_BITMAP_HELVETICA_18,msg[i]);
	for(int i=0;i<strlen(score_str);i++)
		glutBitmapCharacter(GLUT_BITMAP_HELVETICA_18,score_str[i]);
	glutBitmapCharacter(GLUT_BITMAP_HELVETICA_18,'/');
	for(int i=0;i<strlen(msg1);i++)
		glutBitmapCharacter(GLUT_BITMAP_HELVETICA_18,msg1[i]);


if(score==NUM_COIN)
{	if(end==false)
	{ENDING_S = Mix_LoadMUS( "victory.wav" );
	Mix_PlayMusic( ENDING_S, -1 ) ; end=true;
	}char win[50]="Congrats You Win!! Your Score is ";
	
	glColor4f(1.0f, 1.0f, 0.0f, 1.0f);
	glRasterPos3f(-0.25, 0.0,-1);
	for(int i=0;i<strlen(win);i++)
		glutBitmapCharacter(GLUT_BITMAP_HELVETICA_18,win[i]);
	for(int i=0;i<strlen(score_str);i++)
		glutBitmapCharacter(GLUT_BITMAP_HELVETICA_18,score_str[i]);
	//sleep(8);	
	//exit(0);
}
if(gameover)
{

	if(end==false)
	{ENDING_S = Mix_LoadMUS( "game_over.wav" );
	Mix_PlayMusic( ENDING_S, -1 ) ; end=true;
	}char win[50]="Game Over!! You Lose . Your Score is ";
	
	glColor4f(1.0f, 1.0f, 0.0f, 1.0f);
	glRasterPos3f(-0.25, 0.0,-1);
	for(int i=0;i<strlen(win);i++)
		glutBitmapCharacter(GLUT_BITMAP_HELVETICA_18,win[i]);
	for(int i=0;i<strlen(score_str);i++)
		glutBitmapCharacter(GLUT_BITMAP_HELVETICA_18,score_str[i]);
}


}
GLuint AB;
bool music_start=true;
void drawmenu()
{
	if(music_start)
	{

		START_S = Mix_LoadMUS( "open.wav" );
		Mix_PlayMusic( START_S, -1 ) ; 
		music_start=false; 
	}
	glLoadIdentity();
	glPushMatrix();
	glColor3f(1.0, 0.0, 0.0); // Green
	if(tri==0)
	{
		glBegin(GL_TRIANGLES);
		glVertex3f(-.2,.0,-1);
		glVertex3f(-.22,.015,-1);
		glVertex3f(-.22,-.015,-1);
		glEnd();
	}
	else
	{
		glBegin(GL_TRIANGLES);
		glVertex3f(-.2,-.05,-1);
		glVertex3f(-.22,-.035,-1);
		glVertex3f(-.22,-.065,-1);
		glEnd();
	}
	char play[20] = "Play Game";
	glColor4f(1.0f, 1.0f, 1.0f, 1.0f);
	glRasterPos3f(-0.18, -0.01,-1);
	for(int i=0;i<strlen(play);i++)
		glutBitmapCharacter(GLUT_BITMAP_HELVETICA_18,play[i]);
	char exit[20] = "Exit";
	glRasterPos3f(-0.18, -0.058,-1);
	for(int i=0;i<strlen(exit);i++)
		glutBitmapCharacter(GLUT_BITMAP_HELVETICA_18,exit[i]);

	load_bmp("start.bmp",AB);
	glEnable(GL_TEXTURE_2D);
	glTexEnvf(GL_TEXTURE_ENV, GL_TEXTURE_ENV_MODE, GL_DECAL);
	glBindTexture(GL_TEXTURE_2D, AB);
	glColor3f(1,1,1);
	glBegin(GL_QUADS);
	glVertex3f(-1,-.57,-1);glTexCoord2f(0.0, 1.0);
	glVertex3f(-1,.57,-1);glTexCoord2f(1.0, 1.0);
	glVertex3f(1,.57,-1);glTexCoord2f(1.0, 0.0);
	glVertex3f(1,-.57,-1);glTexCoord2f(0.0, 0.0);
	glEnd();
	glDisable(GL_TEXTURE_2D);	



glPopMatrix();
/*
	
glPopMatrix();	
*/

}
void Draw(){
	//cout<<"in draw"<<endl;
	glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);glClearColor(0,0,0,0);
	if(show_menu)
	{
	
	drawmenu();
	}
	else{	
	drawmap(camX,camY,camZ);
	glLoadIdentity();
	glPushMatrix();
	limit(camX,camY,camZ,camVerticalRot,camHorizontalRot);
	display();
	if(!end)
	{glLineWidth(2.0);
	glColor3f(1,1,1);
	glBegin(GL_LINES);
		glVertex3f(.02,0,-1);
		glVertex3f(-.02,0,-1);
		glVertex3f(0,.02,-1);
		glVertex3f(0,-.02,-1);
	glEnd();}
	
	//glTranslatef(-camX,-camY,-camZ);
	
	glPopMatrix();	
	
   	 glLineWidth(1.0f);

	
	if(jump_dir==1)
	{
		camY+=JUMP_HT;
		jump_count++;
		if(jump_count>20)
		jump_dir=-1;
		if(jump_char=='w')
		{
			camX += SPD*sin(camHorizontalRot*pi/180)/3;
			camZ -= SPD*cos(camHorizontalRot*pi/180)/3;
		}
		if(jump_char=='W')
		{camX += SPD*sin(camHorizontalRot*pi/180)/3;
			camZ -= SPD*cos(camHorizontalRot*pi/180)/3;}
		
	}
	else if(jump_dir==-1)
	{
		camY-=JUMP_HT;
		jump_count--;
		if(jump_count<=0)
			{jump_dir=0;jump=0;state[32]=false;jump_char='\0';}
		if(jump_char=='w')
		{
			camX += SPD*sin(camHorizontalRot*pi/180)/3;
			camZ -= SPD*cos(camHorizontalRot*pi/180)/3;
		}
		if(jump_char=='W')
		{camX += SPD*sin(camHorizontalRot*pi/180)/3;
			camZ -= SPD*cos(camHorizontalRot*pi/180)/3;}
		
	}
	checkcollision();}
	glRotatef(camVerticalRot,1,0,0);
	glRotatef(camHorizontalRot,0,1,0);
	glTranslatef(-camX,-camY,-camZ);

	glutSwapBuffers();
	if(end){if(gameover)sleep(4);else sleep(6);exit(0);}
}
void keyUp(unsigned char key, int x, int y){
	state[key] = false;
}

void keyPress(unsigned char key, int x, int y)
{
	state[key] = true;
	if(state[13])
	{
		show_menu=0;
		if(tri==1)exit(0);
		playbackgroundmusic();
	}
	 if(state[32] && state['w']){
		if(jump==0)		
		{
			jump=1;
			jump_dir=1;
			jump_char='w';
			playjumpmusic();
		}
		
	}
	else if(state[32] && state['W']){
		if(jump==0)		
		{
			jump=1;
			jump_dir=1;
			jump_char='W';playjumpmusic();
		}
	}
	else if (state[27]){
		exit(0);
	}
	else if(state[32]){
		if(jump==0)		
		{
			jump=1;
			jump_dir=1;playjumpmusic();
		}
	}
	else if(state['w']){
		camY -= SPD*sin(camVerticalRot*pi/180);
		camX += SPD*sin(camHorizontalRot*pi/180);
		camZ -= SPD*cos(camHorizontalRot*pi/180);
	}
	else if(state['W']){	
		camY -= FSPD*sin(camVerticalRot*pi/180); ;
		camX += FSPD*sin(camHorizontalRot*pi/180);
		camZ -= FSPD*cos(camHorizontalRot*pi/180);
	}
	else if(state['s']){	
		camY += SPD*sin(camVerticalRot*pi/180); ;
		camX -= SPD*sin(camHorizontalRot*pi/180);
		camZ += SPD*cos(camHorizontalRot*pi/180);
	}
	else if(state['S']){	
		camY += FSPD*sin(camVerticalRot*pi/180); ;
		camX -= FSPD*sin(camHorizontalRot*pi/180);
		camZ += FSPD*cos(camHorizontalRot*pi/180);
	}
	else if(state['a']){	
		camX -= (SPD/2)*cos(camHorizontalRot*pi/180); ;
		camZ -= (SPD/2)*sin(camHorizontalRot*pi/180);
		
	}
	else if(state['A']){	
		camX -= (SPD/2)*cos(camHorizontalRot*pi/180); ;
		camZ -= (SPD/2)*sin(camHorizontalRot*pi/180);

	}
	else if(state['d']){	
		camX += (SPD/2)*cos(camHorizontalRot*pi/180); ;
		camZ += (SPD/2)*sin(camHorizontalRot*pi/180);

	}
	else if(state['D']){	
		camX += (SPD/2)*cos(camHorizontalRot*pi/180); ;
		camZ += (SPD/2)*sin(camHorizontalRot*pi/180);
	}
}

void redraw(int width,int height)
{
	glViewport (0,0,width,height);
	glMatrixMode (GL_PROJECTION); 
	glLoadIdentity ();
	gluPerspective (60,(float)width/height,1,100); 
	glMatrixMode (GL_MODELVIEW);
}


void motion(int x,int y)
{
	float dx = 1.0*x-lastPosX;
	float dy = 1.0*y-lastPosY;
	lastPosX = x;
	lastPosY = y;
	camHorizontalRot += dx;
	camVerticalRot += dy; 
	//cout<<x<<" "<<y<<endl;	
	int midx = glutGet(GLUT_WINDOW_WIDTH)/2;
	int midy = glutGet(GLUT_WINDOW_HEIGHT)/2;
	if(abs(x-midx)>midx-10 || abs(y-midy)>midy-10)
	{
		glutWarpPointer(midx,midy);
	}
}
