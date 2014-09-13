
static GLuint texName1;
void drawfloor(float minX,float maxX,float minZ,float maxZ,float Y)
{
glEnable(GL_TEXTURE_2D);
   glTexEnvf(GL_TEXTURE_ENV, GL_TEXTURE_ENV_MODE, GL_DECAL);
   glBindTexture(GL_TEXTURE_2D, texName1);
glBegin(GL_QUADS);
glColor4f(0,1,0,0);
glVertex3f(minX,Y,minZ);glTexCoord2f(0.0, 0.0);
glVertex3f(maxX,Y,minZ);glTexCoord2f(0.0, 1.0);
glVertex3f(maxX,Y,maxZ);glTexCoord2f(1.0, 1.0);
glVertex3f(minX,Y,maxZ);glTexCoord2f(1.0, 1.0);
glEnd();
glDisable(GL_TEXTURE_2D);
}

