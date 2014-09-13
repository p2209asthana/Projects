#include<iostream>
#include<stdlib.h>
#include<string>
#include<stdio.h>
#include<unistd.h>
#include<limits.h>
#include<algorithm>
#define PARENT 0
#define CHILD 1


int MAX_TASK;
int MIN_TASK;
int num_tasks;
int num_procs;

struct task_node
{
int proc_id;
int task_id;
float t_start;
float t_end;
task_node*next;
};
struct node5
{
int proc_id;
float busy_energy;
float idle_energy;
};
struct processor_node
{
float idle_energy;
float busy_energy;
task_node* next;
node5* transfer_arr;
};

struct node1
{
int proc_id;
float r_time;
bool flag;
};

struct node2
{
int task_id;
bool relation;
float c_time;
node2 *next;
};

struct node3
{
int task_id;
int num_procs_used;
node1 *processor_list_arr;
float rank;

node2 *graph_list_head;
task_node* all_copies_head;

};
struct node4
{
int task_id;
int proc_id;
int c_time;
int t_start;
int t_end;
bool covered;
};

struct solution
{
int task_id1;
int proc_id1;
int task_id2;
int proc_id2;
int c_time;
solution*next;
};
using namespace std;

node3* global_task_arr;

processor_node * global_processor_arr;

bool operator <(node3 i, node3 j)
{
if(i.rank<=j.rank)return true;
return false;
} 

void initialize()
{
for(int i=0;i<num_tasks;i++)	
{
	global_task_arr[i].task_id=i;
	global_task_arr[i].num_procs_used=0;
	global_task_arr[i].processor_list_arr=new node1[num_procs];
	for(int j=0;j<num_procs;j++)
		{
			global_task_arr[i].processor_list_arr[j].proc_id=j;
			global_task_arr[i].processor_list_arr[j].r_time=INT_MAX;
			global_task_arr[i].processor_list_arr[j].flag=false;
		}
	global_task_arr[i].graph_list_head=NULL;
	global_task_arr[i].rank=INT_MIN;
}
}
solution* SOL;
int find_index(int id)
{
for(int i=0;i<num_tasks;i++)
if(global_task_arr[i].task_id==id)
return i;
}
void calculate_rank(int id)
{
int index=find_index(id);
float sum=0;
for(int i=0;i<num_procs;i++)
sum+=global_task_arr[index].processor_list_arr[i].r_time;

global_task_arr[index].rank=sum/num_procs;
float max=0;

node2 *curr=global_task_arr[index].graph_list_head;
while(curr!=NULL)
{
	if(curr->relation==CHILD)
	{
		calculate_rank(curr->task_id);
		if(global_task_arr[find_index(curr->task_id)].rank+curr->c_time>max)
			max=global_task_arr[find_index(curr->task_id)].rank+curr->c_time;
		
	}
	curr=curr->next;

}
global_task_arr[index].rank+=max;
}

int find_source()
{
for(int i=0;i<num_tasks;i++)
{
	node2*curr;
	curr=global_task_arr[i].graph_list_head;
	bool flag=true;
	while(curr!=NULL)
	{
		if(curr->relation==PARENT)
		{
			flag=false;break;
		}
		curr=curr->next;
	}
	if(flag)return global_task_arr[i].task_id;///which is actually i//assuming single source
}
}

void printfullinfo()
{
for(int i=0;i<num_tasks;i++)
{
	node3 curr=global_task_arr[i];
	cout<<"id="<<curr.task_id;
	cout<<" rank="<<curr.rank<<endl;
	cout<<"--graph list--"<<endl;
	node2* temp=curr.graph_list_head;
	int count=0;
	while(temp!=NULL)
	{
		cout<<"("<<temp->task_id<<" "<<temp->c_time<<" ";
		if(temp->relation==PARENT)
		cout<<"PARENT)--> ";
		else cout<<"CHILD)--> ";

		temp=temp->next;
		//sleep(1);
		//if(++count==3)
		//exit(0);
	}
	cout<<"(NULL)"<<endl;
	cout<<"procs used="<<global_task_arr[i].num_procs_used<<endl;
	cout<<"--proc list--"<<endl;
	node1* temp1=curr.processor_list_arr;
	for(int j=0;j<num_procs;j++)
	{
		cout<<"(p.id="<<temp1[j].proc_id<<" r_time="<<temp1[j].r_time<<" "<<temp1[j].flag<<")"<<endl;
	}

}
//cout<<"out of print function"<<endl;
return ;
}
int XXX;
bool mycompare(node1 i, node1 j)
{
int idi=i.proc_id;
int idj=j.proc_id;
int XXX_id=global_task_arr[XXX].task_id;
if(global_task_arr[XXX].processor_list_arr[idi].flag==0)return false;
if(global_task_arr[XXX].processor_list_arr[idj].flag==0)return true;

task_node*temp=global_processor_arr[idi].next;
task_node*temp1=global_processor_arr[idj].next;
while(temp!=NULL)
{
	if(temp->task_id==XXX_id)
	break;
	temp=temp->next;
}
while(temp1!=NULL)
{
	if(temp1->task_id==XXX_id)
	break;
	temp1=temp1->next;
}
if(temp->t_start>=temp1->t_start)return true;
return false;

}

void delete_task(int proc_id,int task_id)
{
task_node*curr=global_processor_arr[proc_id].next;
if(curr->task_id==task_id)
{global_processor_arr[proc_id].next=curr->next;
return;}
task_node*parent=curr;
while(curr!=NULL)
{
if(curr->task_id==task_id)
{
parent->next=curr->next;
return;
}
parent=curr;
curr=curr->next;
}

}
void Delete(node1*temp_arr)
{
int task_id=global_task_arr[XXX].task_id;
node4* child_copy_arr=new node4[5*num_tasks];//think of it as an upper limit
for(int i=0;i<5*num_tasks;i++)
child_copy_arr[i].covered=false;
node2 *curr=global_task_arr[XXX].graph_list_head;
int count=0;
while(curr!=NULL)
{
	if(curr->relation==CHILD)
	{
		int index=find_index(curr->task_id);
		for(int i=0;i<num_procs;i++)
		{
			if(global_task_arr[index].processor_list_arr[i].flag==1)
			{
				child_copy_arr[count].task_id=global_task_arr[index].task_id;
				child_copy_arr[count].proc_id=global_task_arr[index].processor_list_arr[i].proc_id;
				child_copy_arr[count].c_time=curr->c_time;
				int YYY=global_task_arr[index].processor_list_arr[i].proc_id;
				task_node *curr=global_processor_arr[YYY].next;
				while(curr!=NULL)
				{
					if(curr->task_id==global_task_arr[index].task_id)
							break;
					curr=curr->next;
				}
				child_copy_arr[count].t_start=curr->t_start;
				child_copy_arr[count].t_end=curr->t_end;
				count++;
			}
		}		
		
		
	}
	curr=curr->next;
}
/*for(int i=0;i<count;i++)
{
cout<<child_copy_arr[i].task_id<<" "<<child_copy_arr[i].proc_id<<" "<<child_copy_arr[i].c_time<<" "<<child_copy_arr[i].t_start<<" "<<child_copy_arr[i].t_end<<" "<<endl;
}*/
//cout<<endl;fflush(stdout);
int iterator;
int PROCESSOR_ID;
float FINISH_TIME;
for ( iterator=0;iterator<num_procs;iterator++)
{
	bool gate=true;
	for(int j=0;j<count;j++)
		if(child_copy_arr[j].covered==false)
		{	//cout<<"This is uncovered-->"<<child_copy_arr[j].task_id<<endl;fflush(stdout);
			gate=false;
			break;
		}
	if(gate==true)
		break;
	//cout<<"gate="<<gate<<endl;fflush(stdout);
	PROCESSOR_ID=temp_arr[iterator].proc_id;
	task_node* curr=global_processor_arr[PROCESSOR_ID].next;
	while(curr!=NULL)
	{
		if(curr->task_id==task_id)
		break;
		curr=curr->next;
	}
	FINISH_TIME=curr->t_end;
	bool atleast_once=false;
	for(int j=0;j<count;j++)
	{
		int multiplier=1;
		if(PROCESSOR_ID==child_copy_arr[j].proc_id)
			multiplier=0;
		if(FINISH_TIME+multiplier*child_copy_arr[j].c_time<=child_copy_arr[j].t_start)
			{
				child_copy_arr[j].covered=true;
				atleast_once=true;
			}
	}
	if(atleast_once==false)
	{
		int proc_id=temp_arr[iterator].proc_id;
		temp_arr[iterator].flag=0;
		global_task_arr[XXX].processor_list_arr[proc_id].flag=false;
		delete_task(proc_id,task_id);
		global_task_arr[XXX].num_procs_used--;
	}
}
//all copies less then iterator has been handled so far
//now perform actual task deletion
//cout<<"iterator="<<iterator<<endl;
for(int i=iterator;i<num_procs;i++)
{
if(temp_arr[i].flag==0)break;
int proc_id=temp_arr[i].proc_id;
temp_arr[i].flag=0;
global_task_arr[XXX].processor_list_arr[proc_id].flag=false;
delete_task(proc_id,task_id);
global_task_arr[XXX].num_procs_used--;
}
//exit(0);
}


void algorithm()
{
for(int i=0;i<num_tasks;i++)
{	XXX=i;
	int counter=0;
	if(global_task_arr[i].num_procs_used>1)
	{
		//cout<<"num_procs_used="<<global_task_arr[i].num_procs_used<<endl;fflush(stdout);
		node1 *temp_arr=new node1[num_procs];

		for(int j=0;j<num_procs;j++)
		temp_arr[j]=global_task_arr[XXX].processor_list_arr[j];

		/*for(int j=0;j<num_procs;j++)
		{
			cout<<temp_arr[j].proc_id<<" "<<temp_arr[j].r_time<<" "<<temp_arr[j].flag<<endl;
		}
		fflush(stdout);*/
		sort(temp_arr,temp_arr+num_procs,mycompare);
		/*for(int j=0;j<num_procs;j++)
		{
			cout<<temp_arr[j].proc_id<<" "<<temp_arr[j].r_time<<" "<<temp_arr[j].flag<<endl;
		}fflush(stdout);*/
		Delete(temp_arr);
		//cout<<"ha!! finally deleted"<<endl;fflush(stdout);
		
	}
	//if(i==4)return;

}


}
void printprocess()
{

for(int i=0;i<num_procs;i++)
{
	cout<<"Proc "<<i<<" ";
	task_node*curr=global_processor_arr[i].next;
	while(curr!=NULL)
	{
		cout<<curr->task_id<<" [ "<<curr->t_start<<" , "<<curr->t_end<<" ] ";

	curr=curr->next;
	}
	cout<<endl;
}
}
void print_energy_processor()
{
float busy=0,idle=0;
for(int i=0;i<num_procs;i++)
{
	float busytime=0,idletime=0,first=0,last=0;
	task_node*curr=global_processor_arr[i].next;
	//first=curr->t_begin;
	while(curr!=NULL)
	{	
		busytime+=(curr->t_end-curr->t_start);
		last=curr->t_end;
		curr=curr->next;
	}
	idletime=last-busytime;
	busy+=global_processor_arr[i].busy_energy*busytime;
	idle+=global_processor_arr[i].idle_energy*idletime;
}
cout<<"Energy Processor (busy,idle)= ("<<busy<<","<<idle<<")"<<endl;
}

void find_all_copies(int target_id)
{
	int index=find_index( target_id);
	task_node *current_task_head=new task_node();//acts as sentinel
	task_node * CURRENT=current_task_head;
	current_task_head->next=NULL;
	for(int j=0;j<num_procs;j++)
	{
		task_node*curr=global_processor_arr[j].next;
		while(curr!=NULL)
		{	
			if(curr->task_id==target_id)
			{
				CURRENT->next=new task_node();
				CURRENT->task_id=curr->task_id;
				CURRENT->proc_id=curr->proc_id;
				CURRENT->t_start=curr->t_start;
				CURRENT->t_end=curr->t_end;
				CURRENT=CURRENT->next;
				CURRENT->next=NULL;
			}
			curr=curr->next;
		}
	}
	global_task_arr[index].all_copies_head=current_task_head->next;

}
void print_energy_communication()
{
	float energy=0;
	for(int i=0;i<num_tasks;i++)
	find_all_copies(global_task_arr[i].task_id);
	for(int i=0;i<num_tasks;i++)
	{
		task_node*curr=global_task_arr[i].all_copies_head;
		while(curr!=NULL)//for all copies
		{
			task_node node1=*curr;
			node2* curr1=global_task_arr[i].graph_list_head;
			while(curr1!=NULL)//for all parents
			{	float min=INT_MAX;
				int parent_id=curr1->task_id;int parent_proc_id;
				float c_time=curr1->c_time;
				if(curr1->relation==PARENT)
				{
					int parentindex=find_index(parent_id);
					task_node*curr2=global_task_arr[parentindex].all_copies_head;
					
					while(curr2!=NULL)//for all copies of parents
					{
						float contact_time=0;
						task_node node2=(*curr2);
						//contact_time+=node2.t_end;	
						if(node1.proc_id!=node2.proc_id)contact_time=c_time;
						curr2=curr2->next;
						if(contact_time<min){min=contact_time;parent_proc_id=node2.proc_id;}
					}
				}
				solution* temp=new solution();
				temp->task_id1=global_task_arr[i].task_id;
				temp->task_id2=parent_id;
				temp->proc_id1=node1.proc_id;
				temp->proc_id2=parent_proc_id;
				temp->c_time=min;
				temp->next=SOL;
				SOL=temp;
				curr1=curr1->next;
			}
			curr=curr->next;	
		}

	}

cout<<"Edge List -------------"<<endl;
solution*curr=SOL;
while(curr->next!=NULL)
{
if(curr->c_time!=0)
cout<<"Edge from "<<curr->task_id1<<" "<<curr->proc_id1<<" - "<<curr->task_id2<<" "<<curr->proc_id2<<" "<<curr->c_time<<endl;

curr=curr->next;
}
}
void printmakespan()
{

float makespan=0;
for(int i=0;i<num_procs;i++)
{
	task_node*curr=global_processor_arr[i].next;
	while(curr!=NULL)
	{
		if(curr->t_end>makespan)makespan=curr->t_end;
		curr=curr->next;
	}

	}
cout<<"Makespan= "<<makespan<<endl;
}
int main()
{

 SOL=new solution();
SOL->next=NULL;

cin>>num_tasks>>num_procs;
global_task_arr=new node3[num_tasks];

initialize();

//stores runnig time of each task on every processor
for(int i=0;i<num_tasks;i++)
	for(int j=0;j<num_procs;j++)
		cin>>global_task_arr[i].processor_list_arr[j].r_time;

for(int i=0;i<num_tasks;i++)
	global_task_arr[i].all_copies_head=NULL;


while(1)
{
	int i,j;
	cin>>i;
	if(i==-1)
	break;
	node2 *temp=new node2();
	cin>>j;
	temp->task_id=j;
	cin>>temp->c_time;
	temp->relation=CHILD;//depicts relation of j to i
	temp->next=global_task_arr[i].graph_list_head;
	global_task_arr[i].graph_list_head=temp;//j adding to list of i
	
	node2 *temp1=new node2();
	temp1->task_id=i;
	temp1->c_time=temp->c_time;
	temp1->relation= PARENT;//depicts relation of i to j
	temp1->next=global_task_arr[j].graph_list_head;
	global_task_arr[j].graph_list_head=temp1;// i adding to list of j
	
}

calculate_rank(find_source());


global_processor_arr= new processor_node[num_procs];
for(int i=0;i<num_procs;i++)
	global_processor_arr[i].next=NULL;

for(int i=0;i<num_procs;i++)
	cin>>global_processor_arr[i].idle_energy>>global_processor_arr[i].busy_energy;

for(int i=0;i<num_procs;i++)
	global_processor_arr[i].transfer_arr=new node5[num_procs];
for(int i=0;i<num_procs;i++)
		for(int j=0;j<num_procs;j++)
		{
			global_processor_arr[i].transfer_arr[j].proc_id=j;
			global_processor_arr[i].transfer_arr[j].busy_energy=global_processor_arr[i].transfer_arr[j].idle_energy=0;
		}

int nc2=(num_procs*(num_procs-1))/2;
while(1)
{
	int i,j;
	cin>>i;if(i==-1)break;
	cin>>j;
	cin>>global_processor_arr[i].transfer_arr[j].idle_energy>>global_processor_arr[i].transfer_arr[j].busy_energy;
	global_processor_arr[j].transfer_arr[i].idle_energy=global_processor_arr[i].transfer_arr[j].idle_energy;
	global_processor_arr[j].transfer_arr[i].busy_energy=global_processor_arr[i].transfer_arr[j].busy_energy;

}

for(int i=0;i<num_procs;i++)
{	
	task_node*curr=global_processor_arr[i].next;
	while(1)
	{
		task_node *temp_node=new task_node();
		int temp;
		
		cin>>temp;
		if(temp==-1)
			break;
		
		temp_node->task_id=temp;
		temp_node->proc_id=i;
		cin>>temp_node->t_start;
		cin>>temp_node->t_end;
		fflush(stdout);
		temp_node->next=NULL;
		
		if(curr==NULL)
			{global_processor_arr[i].next=temp_node;curr=temp_node;}
		else
		{
			curr->next=temp_node;
			curr=curr->next;
		}
		//global_task_arr[curr->task_id].processor_list_arr[i].proc_id=i;
		//cout<<"target id="<<endl;fflush(stdout);
		if(curr!=NULL)
		{		
			global_task_arr[curr->task_id].processor_list_arr[i].flag=true;
			global_task_arr[curr->task_id].num_procs_used++;
		}		
		
	}
//cout<<"before_algorithm ";fflush(stdout);

}
sort(global_task_arr,global_task_arr+num_tasks);
//printfullinfo();
//
algorithm();
//cout<<"after_algortihm "; fflush(stdout);
//printfullinfo();

printmakespan();
print_energy_processor();
//print_energy_communication();
printprocess();
return 0;
}
