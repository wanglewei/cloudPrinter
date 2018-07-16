#include <stdio.h>
#include <stdlib.h>


struct line
{
    int l;
    long long max;
    int pre;
}tline[3][10000001];
long long vals[10000001];
long long max(long long a,long long b){
    return a > b ? a : b;
}

long long get(int x)
{
    return vals[x];
}
int main ()
{
    int len,k;
    int a,b,c;
    scanf("%d%d",&len,&k);
    
    for(int i = 0 ; i < len ; i ++){
        vals[i] = 0;
    }
    for (int i = 0 ; i < len ; i ++){
        int this;
        scanf("%d",&this);
        vals[i] = this;
        if(i > 0){
            vals[i] += vals[i - 1];
        }
        if(i == k - 1)
        {
            tline[0][i].max = get(i);
            tline[0][i].l = 1;
        }
        else if (i >= k)
        {
            if(tline[0][i - 1].max < get(i) - get(i - k))
            {
                tline[0][i].l = i - k + 2;
            }
            else 
            {
                tline[0][i].l = tline[0][i - 1].l;
            }
            tline[0][i].max = max(tline[0][i - 1].max,get(i) - get(i - k));
        }
    }
    for (int i = 1 ; i < 3 ; i ++)
    {
        for (int j = i * k + k - 1 ; j < len ; j ++)
        {
            tline[i][j].max = get(j) - get(j - k) + tline[i - 1][j - k].max;
            if(tline[i][j-1].max < tline[i][j].max){
                tline[i][j].l = j - k + 2;
                tline[i][j].pre = j - k;
            }
            else {
                tline[i][j].l = tline[i][j - 1].l;
                tline[i][j].pre = tline[i][j - 1].pre;
            }
            tline[i][j].max = max(tline[i][j - 1].max,tline[i][j].max);   
        }
    }
    c = tline[2][len - 1].l;
    b = tline[1][tline[2][len - 1].pre].l;
    a = tline[0][tline[1][tline[2][len - 1].pre].pre].l;
    printf("%d %d %d",a - 1,b - 1,c - 1);
}