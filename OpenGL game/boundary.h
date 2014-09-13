

int BOUNDARY_minX;
int BOUNDARY_maxX;
int BOUNDARY_minZ;
int BOUNDARY_maxZ;
#define A glTexCoord2f(0.0,0.0)
#define B glTexCoord2f(0.0,1.0);
#define C glTexCoord2f(1.0, 1.0);
#define D glTexCoord2f(1.0, 0.0);


static GLuint texName2;

void drawboundary(float minX, float maxX,float minY,float maxY,float minZ,float maxZ)
{
glEnable(GL_TEXTURE_2D);
   glTexEnvf(GL_TEXTURE_ENV, GL_TEXTURE_ENV_MODE, GL_DECAL);
   glBindTexture(GL_TEXTURE_2D, texName2);
glBegin(GL_QUADS);//left
glColor4f(165.0/256,42.0/256, 42.0/256,0);
glVertex3f(minX,minY,minZ);A;
glVertex3f(minX,minY,maxZ);B;
glVertex3f(minX,maxY,maxZ);D;
glVertex3f(minX,maxY,minZ);C;
glEnd();
glDisable(GL_TEXTURE_2D);
glEnable(GL_TEXTURE_2D);
   glTexEnvf(GL_TEXTURE_ENV, GL_TEXTURE_ENV_MODE, GL_DECAL);
   glBindTexture(GL_TEXTURE_2D, texName2);

glBegin(GL_QUADS);//right
glColor4f(165.0/256,42.0/256, 42.0/256,0);
glVertex3f(maxX,minY,minZ);A;
glVertex3f(maxX,maxY,minZ);B;
glVertex3f(maxX,maxY,maxZ);C;
glVertex3f(maxX,minY,maxZ);D;
glEnd();
glDisable(GL_TEXTURE_2D);


glEnable(GL_TEXTURE_2D);
glTexEnvf(GL_TEXTURE_ENV, GL_TEXTURE_ENV_MODE, GL_DECAL);
glBindTexture(GL_TEXTURE_2D, texName2);
glBegin(GL_QUADS);//back
glColor4f(165.0/256,42.0/256, 42.0/256,0);
glVertex3f(minX,minY,maxZ);glTexCoord2f(0.0, 0.0);
glVertex3f(maxX,minY,maxZ);glTexCoord2f(0.0, 1.0);
glVertex3f(maxX,maxY,maxZ);glTexCoord2f(1.0, 1.0);
glVertex3f(minX,maxY,maxZ);glTexCoord2f(1.0, 0.0);
glEnd();
glDisable(GL_TEXTURE_2D);

glEnable(GL_TEXTURE_2D);
   glTexEnvf(GL_TEXTURE_ENV, GL_TEXTURE_ENV_MODE, GL_DECAL);
   glBindTexture(GL_TEXTURE_2D, texName2);
glBegin(GL_QUADS);//front
glColor4f(165.0/256,42.0/256, 42.0/256,0);
glVertex3f(minX,minY,minZ);glTexCoord2f(0.0, 0.0);
glVertex3f(maxX,minY,minZ);glTexCoord2f(0.0, 1.0);
glVertex3f(maxX,maxY,minZ);glTexCoord2f(1.0, 1.0);
glVertex3f(minX,maxY,minZ);glTexCoord2f(1.0, 0.0);
glEnd();
glDisable(GL_TEXTURE_2D);
/*
glBegin(GL_LINES);
glColor3f(1,1,1);
glVertex3f(minX,minY,minZ);
glVertex3f(minX,maxY,minZ);
glEnd();

glBegin(GL_LINES);
glVertex3f(minX,maxY,minZ);
glVertex3f(minX,maxY,maxZ);
glEnd();

glBegin(GL_LINES);
glVertex3f(minX,maxY,maxZ);
glVertex3f(minX,minY,maxZ);
glEnd();

glBegin(GL_LINES);
glVertex3f(minX,minY,maxZ);
glVertex3f(minX,minY,minZ);
glEnd();
//------------------------
glBegin(GL_LINES);
glVertex3f(maxX,minY,minZ);
glVertex3f(maxX,maxY,minZ);
glEnd();

glBegin(GL_LINES);
glVertex3f(maxX,maxY,minZ);
glVertex3f(maxX,maxY,maxZ);
glEnd();

glBegin(GL_LINES);
glVertex3f(maxX,maxY,maxZ);
glVertex3f(maxX,minY,maxZ);
glEnd();

glBegin(GL_LINES);
glVertex3f(maxX,minY,maxZ);
glVertex3f(maxX,minY,minZ);
glEnd();
//-------------------

glBegin(GL_LINES);
glVertex3f(minX,minY,maxZ);
glVertex3f(maxX,minY,maxZ);
glEnd();

glBegin(GL_LINES);
glVertex3f(maxX,minY,maxZ);
glVertex3f(maxX,maxY,maxZ);
glEnd();

glBegin(GL_LINES);
glVertex3f(maxX,maxY,maxZ);
glVertex3f(minX,maxY,maxZ);
glEnd();

glBegin(GL_LINES);
glVertex3f(minX,maxY,maxZ);
glVertex3f(minX,minY,maxZ);
glEnd();
//----------------------


glBegin(GL_LINES);
glVertex3f(minX,minY,minZ);
glVertex3f(maxX,minY,minZ);
glEnd();

glBegin(GL_LINES);
glVertex3f(maxX,minY,minZ);
glVertex3f(maxX,maxY,minZ);
glEnd();

glBegin(GL_LINES);
glVertex3f(maxX,maxY,minZ);
glVertex3f(minX,maxY,minZ);
glEnd();

glBegin(GL_LINES);
glVertex3f(minX,maxY,minZ);
glVertex3f(minX,minY,minZ);*/
glEnd();
}


