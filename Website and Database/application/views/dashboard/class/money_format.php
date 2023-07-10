<script>

// MONEY FORMATTING
function formatCurrency(total) {
  var neg = false;
  if(total < 0) {
      neg = true;
      total = Math.abs(total);
  }
  return (neg ? "-" : '') + parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
  // return (neg ? "-₱" : '₱') + parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
}

</script>