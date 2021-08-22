#include <stdio .h>

int add(int, int);
int mul(int, int);

int main() {
  int four , three , result ; // breakpoint 1
  four = 4; three = 3;
  result=mul(four, three);
  printf(”%d x %d =%d\n”, four, three, result);
  return 0; // breakpoint 4
}

int add( int a , int b) {
  int first , second , result ; // breakpoint 3 first = a;
  second = b;
  result = first + second;
  return result ;
}

int mul(int x, int y) {
  int number , multiplier , result , i ; // breakpoint 2
  number = x; multiplier = y; result = 0;
  i = 0;

  while (i < multiplier) {
    result = add(result , number);
    i = i + 1;
  }
  return result;
}
