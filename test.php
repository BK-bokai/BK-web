<script>

var a=false;
var b=true;
var c=false;

if(b)
{
   if(a)
   {
      console.log('yes')
   }

   var a=true;
   if(a)
   {
      console.log('a is true')
      var c = true;
   }

   if(a & b & c)
   {
      console.log('a,b,c')
   }
   
}

</script>