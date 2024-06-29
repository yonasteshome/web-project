var click = parseInt(document.getElementById("value").value);
var clicks = parseInt(document.getElementById("values").value);
var total = parseInt(document.getElementById("totals").value);
var vip = parseInt(document.getElementById("vip").value); // Get the VIP value

document.getElementById("plus").addEventListener("click", function() {
  click = click + 1;
  document.getElementById("value").value = click;
  document.getElementById("totals").innerHTML = (click + clicks) * vip; // Multiply the total with the VIP value
});

document.getElementById("minus").addEventListener("click", function() {
  click = click - 1;
  document.getElementById("value").value = click;
  document.getElementById("totals").innerHTML = (click + clicks) * vip; // Multiply the total with the VIP value
});

document.getElementById("pluses").addEventListener("click", function() {
  clicks = clicks + 1;
  document.getElementById("values").value = clicks;
  document.getElementById("totals").innerHTML = (click + clicks) * vip; // Multiply the total with the VIP value
});

document.getElementById("minuses").addEventListener("click", function() {
  clicks = clicks - 1;
  document.getElementById("values").value = clicks;
  document.getElementById("totals").innerHTML = (click + clicks) * vip; // Multiply the total with the VIP value
});

var title = document.getElementById("thistitle").value;