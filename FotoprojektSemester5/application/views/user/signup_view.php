<section class="jumbotron text-xs-left">
<div class="container">
<div class="row">
<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link active" id="kunde" onclick="einblendenfotograf()">Kunde</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="fotograf" onclick="einblendenfotograf()">Fotograf</a>
  </li>
</ul>
</div>
<br>
<form>
<div class="form-group">
<fieldset class="form-group">
<div class="row">
    <h3 class="jumbotron-heading">Persönliche Angaben:</h3>
    <br>
    </div>
    <div class="form-check">
    <div class="row">
    <div class="col-sm-3">
      <label class="form-check-label">
        <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1" checked>
        Frau
      </label>
    <label class="form-check-label">
        <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
        Herr
      </label>
      </div>
      </div>
    </div>
    </fieldset>
 </div>
 <div class="row">
    <div class="col-sm-11">
    <input type="text" class="form-control" id="vorname" placeholder="Vorname">
    </div>
 </div>
 <br>
  <div class="row">
    <div class="col-sm-11">
    <input type="text" class="form-control" id="nachname" placeholder="Nachname">
    </div>
 </div>
 <br>
  <div class="row">
    <div class="col-sm-11">
    <div class="form-group">
    <select class="form-control" id="land">
      <option>Deutschland</option>
    </select>
  </div>
    </div>
 </div>
  <div class="row">
    <div class="col-sm-2">
    <input type="text" class="form-control" id="plz" placeholder="PLZ">
    </div>
    <div class="col-sm-9">
    <input type="text" class="form-control" id="ort" placeholder="Ort">
    </div>
 </div>
 <br>
   <div class="row">
    <div class="col-sm-9 col-xs-9">
    <input type="text" class="form-control" id="str" placeholder="Straße">
    </div>
    <div class="col-sm-2 col-xs-2">
    <input type="text" class="form-control" id="hausnr" placeholder="Hausnr">
    </div>
 </div>
 <br>
    <div class="row">
    <div class="col-sm-11">
    	<!--  <input type="date" class="form-control input-sm chat-input" placeholder="Datum" name="even_date" value="<?php echo set_value('even_date'); ?>"/>  -->
		<input type="date" class="form-control input-sm chat-input" placeholder="Datum" name="even_date"/>
	    <span class="text-danger"><?php echo form_error('even_date'); ?></span>
 </div>
 </div> 
 <br>
  <div class="row">
    <div class="col-sm-11">
    <input type="email" class="form-control" id="email" placeholder="E-Mail">
    </div>
 </div>
 <br>
   <div class="row">
    <div class="col-sm-11">
    <input type="email" class="form-control" id="emailwdh" placeholder="E-Mail wiederholen">
    </div>
    </div>
<br>
  <div class="row">
    <div class="col-sm-11">
    <input class="form-control" type="password" id="pw" placeholder="Passwort">
    </div>
 </div>
 <br>
   <div class="row">
    <div class="col-sm-11">
    <input class="form-control" type="password" id="pwwdh" placeholder="Passwort wiederholen">
    </div>
    </div> 
<div id="signupfotograf" style="display:none">
   <div class="row">
    <div class="col-sm-11">
    <input type="text" class="form-control" id="kontoinhaber" placeholder="Kontoinhaber">
    </div>
    </div>
     <div class="row">
    <div class="col-sm-11">
    <input type="text" class="form-control" id="iban" placeholder="IBAN">
    </div>
    </div>
     <div class="row">
    <div class="col-sm-11">
    <input type="text" class="form-control" id="bic" placeholder="BIC">
    </div>
    </div>
</div>        
<br>
<div class="row">
<div class="col-sm-11">
<div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" class="form-check-input">
      AGB zustimmen
    </label>
  </div>
</div>
</div>
<div class="row">
<div class="col-sm-11">
<div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" class="form-check-input">
      Datenschutzrichtlinien akzeptieren
    </label>
  </div>
</div>
</div> 
<div class="row">
<div class="col-sm-11">
<div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" class="form-check-input">
      Newsletter abonnieren
    </label>
  </div>
</div>
</div>
<div class="row">
<div class="col-sm-5">
</div>
<div class="col-sm-6">
<button name="submit" type="submit" class="btn btn-primary btn-md">Registrieren</button>
</div>
</div>    
</form>
</div>
</section>

<script type="text/javascript">

function fotografeinblenden()
{
	if (email === ''){
        document.getElementById("signupfotograf").style.display = "block";
    } else {
        document.getElementById("signupfotograf").style.display = "none";
    }
}

</script>
