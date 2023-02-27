<!DOCTYPE html>
<html>
<body>

<p>Click "Try it" to call a function with arguments</p>

<input type="checkbox" id="myCheck" onclick="myFunction('Harry Potter','Wizard')">

<p id="demo"></p>

<script>
        function myFunction(name,job) {
          document.getElementById("demo").innerHTML = "Welcome " + name + ", the " + job + ".";
        }
</script>

</body>
</html>
