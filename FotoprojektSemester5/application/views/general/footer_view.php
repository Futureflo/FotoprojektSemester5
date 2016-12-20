
<!-- Der Reiter Zahlungsmethoden muss noch hinzugefügt werden -->

<footer class="footer">
	<div class="container">
		<div class="row offset-md-2">
			<div class="col-md-2 text-center"><p><a class="text-muted" href="<?php echo base_url();?>legalnotice/">Impressum</a></p> </div>
			<div class="col-md-2 text-center"><p><a class="text-muted" href="<?php echo base_url();?>contact/">Kontakt</a></p></div>
			<div class="col-md-2 text-center"><p><a class="text-muted" href="<?php echo base_url();?>termsandconditions/">AGB</a></p></div>
			<div class="col-md-2 text-center"><p><a class="text-muted" href="<?php echo base_url();?>privacypolicy/">Datenschutzrichtlinie</a></p></div>
		</div>
	</div>
</footer>

<!-- TEMP -->
<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>

<script>
function load(img)
{
  img.fadeOut(0, function() {
    img.fadeIn(1000);
  });
}
$('.lazyload').lazyload({threshold: 225,load: load});
</script>


<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="<?php echo base_url();?>temp/tether.min.js.Download"></script>
<script>
      $(function () {
        Holder.addTheme("thumb", { background: "#55595c", foreground: "#eceeef", text: "Thumbnail" });
      });
    </script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script
	src="<?php echo base_url();?>temp/ie10-viewport-bug-workaround.js.Download"></script>
<link rel="stylesheet" href="<?php echo base_url();?>temp/album.css">
</body>
</html>