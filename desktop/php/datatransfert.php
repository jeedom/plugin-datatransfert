<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
sendVarToJS('eqType', 'datatransfert');
$eqLogics = eqLogic::byType('datatransfert');
?>

<div class="row row-overflow">
   <div class="col-lg-10 col-md-9 col-sm-8 eqLogicThumbnailDisplay">
   <legend><i class="fas fa-cog"></i>  {{Gestion}}</legend>     
    <div class="eqLogicThumbnailContainer">
      <div class="cursor eqLogicAction" data-action="add">
            <i class="fa fa-plus-circle"></i>
        <br>
        <span>{{Ajouter}}</span>
    </div>
	 </div>    
     <legend><i class="icon techno-memory"></i>  {{Mes Equipements Datatransfert}}</legend>
    <?php
foreach ($eqLogics as $eqLogic) {
	$opacity = ($eqLogic->getIsEnable()) ? '' : 'disableCard';
	echo '<div class="eqLogicDisplayCard cursor '.$opacity.'" data-eqLogic_id="' . $eqLogic->getId() . '">';
	echo '<img src="' . $plugin->getPathImgIcon() . '" />';
	echo "<br>";
	echo '<span>' . $eqLogic->getHumanName(true, true) . '</span>';
	echo '</div>';
}
?>
</div>
</div>

<div class="col-lg-10 col-md-9 col-sm-8 eqLogic" style="display: none;">
	<div class="input-group pull-right" style="display:inline-flex">
		<span class="input-group-btn">
				<a class="btn btn-default btn-sm eqLogicAction roundedLeft" data-action="configure"><i class="fas fa-cogs"></i> {{Configuration avancée}}</a><a class="btn btn-default btn-sm eqLogicAction" data-action="copy"><i class="fas fa-copy"></i> {{Dupliquer}}</a><a class="btn btn-sm btn-success eqLogicAction" data-action="save"><i class="fas fa-check-circle"></i> {{Sauvegarder}}</a><a class="btn btn-danger btn-sm eqLogicAction roundedRight" data-action="remove"><i class="fas fa-minus-circle"></i> {{Supprimer}}</a>
			</span>
	</div>
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation"><a href="" class="eqLogicAction" aria-controls="home" role="tab" data-toggle="tab" data-action="returnToThumbnailDisplay"><i class="fas fa-arrow-circle-left"></i></a></li>
		<li role="presentation" class="active"><a href="#eqlogictab" aria-controls="home" role="tab" data-toggle="tab"><i class="fas fa-tachometer-alt"></i> {{Equipement}}</a></li>
		<li role="presentation"><a href="#commandtab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-list-alt"></i> {{Commandes}}</a></li>
	</ul>
	<div class="tab-content" style="height:calc(100% - 50px);overflow:auto;overflow-x: hidden;">
		<div role="tabpanel" class="tab-pane active" id="eqlogictab">
    <div class="row">
        <div class="col-sm-6">
            <form class="form-horizontal">
                <fieldset>
                    <legend><i class="fa fa-arrow-circle-left eqLogicAction cursor" data-action="returnToThumbnailDisplay"></i> {{Général}}<i class='fa fa-cogs eqLogicAction pull-right cursor expertModeVisible' data-action='configure'></i></legend>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{Nom de l'équipement Data transfert}}</label>
                        <div class="col-sm-4">
                            <input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display : none;" />
                            <input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom de l'équipement Data transfert}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >{{Objet parent}}</label>
                        <div class="col-sm-6">
                            <select class="eqLogicAttr form-control" data-l1key="object_id">
                                <option value="">{{Aucun}}</option>
                                <?php
foreach (object::all() as $object) {
	echo '<option value="' . $object->getId() . '">' . $object->getName() . '</option>';
}
?>
                           </select>
                       </div>
                   </div>
                   <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                    	<label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isEnable" checked/>{{Activer}}</label>
			<label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isVisible" checked/>{{Visible}}</label>
                   </div>
               </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">{{Type}}</label>
                <div class="col-sm-4">
                    <select class="form-control eqLogicAttr" data-l1key="configuration" data-l2key="protocol">
                        <?php
foreach (datatransfert::supportedProtocol() as $protocol) {
	echo '<option value="' . $protocol . '">' . $protocol . '</option>';
}
?>
                   </select>
               </div>
           </div>
       </fieldset>
   </form>
</div>
<div class="col-sm-6">
    <form class="form-horizontal">
        <fieldset>
            <legend><i class="fas fa-wrench"></i>  {{Paramètres}}</legend>
            <div id="div_protocolParameters"></div>
        </fieldset>
    </form>
</div>
</div>
	</div>
			<div role="tabpanel" class="tab-pane" id="commandtab">		

<a class="btn btn-success btn-sm cmdAction" data-action="add"><i class="fas fa-plus-circle"></i> {{Ajouter une commande Data transfert}}</a><br/><br/>
<table id="table_cmd" class="table table-bordered table-condensed">
    <thead>
        <tr>
            <th>{{Nom}}</th><th>{{Source}}</th><th>{{Cible}}</th><th>{{Filtre}}</th><th></th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
</div>
</div>
</div>
</div>

<?php include_file('desktop', 'datatransfert', 'js', 'datatransfert');?>
<?php include_file('core', 'plugin.template', 'js');?>
