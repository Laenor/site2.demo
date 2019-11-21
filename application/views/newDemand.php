<main>
		<?php echo validation_errors(); ?>
		<?php echo form_open(base_url('newDemand')); ?>
		<h5>Nom</h5>
		<input type="text" name="nom_utilisateur" required value="<?php echo set_value('nom_utilisateur')?>" size="50" />
		<h5>Titre</h5>
		<input type="text" name="titre_demande" required value="<?php echo set_value('titre_demande')?>" size="50" />
		<h5>Description</h5>
		<textarea name="description_demande" required rows="4" cols="52" ><?php echo set_value('description_demande')?></textarea>
		<h5>Budget</h5>
		<input type="number" min="0.00" step="0.01" required name="budget_demande" value="<?php echo set_value('budget_demande')?>" size="50" /> €
		<div><input type="submit" value="Valider" /></div>
		<?php if(isset($valid) && $valid== true):?>
			<p>Demande validée</p>
		<?php endif;?>
		</form>

</main>
