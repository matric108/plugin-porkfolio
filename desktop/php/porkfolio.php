<?php
if (!isConnect('admin')) {
    throw new Exception('{{401 - Accès non autorisé}}');
}
sendVarToJS('eqType', 'porkfolio');
$eqLogics = eqLogic::byType('porkfolio');
?>
<div class="row row-overflow">
    <div class="col-lg-2">
        <div class="bs-sidebar">
            <ul id="ul_eqLogic" class="nav nav-list bs-sidenav">
                <a class="btn btn-default eqLogicAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter un porkfolio}}</a>
                <li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
                <?php
                foreach ($eqLogics as $eqLogic) {
                    echo '<li class="cursor li_eqLogic" data-eqLogic_id="' . $eqLogic->getId() . '"><a>' . $eqLogic->getHumanName(true) . '</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
	<div class="col-lg-10 col-md-9 col-sm-8 eqLogicThumbnailDisplay" style="border-left: solid 1px #EEE; padding-left: 25px;">
        <legend>{{Mes porkfolios}}
        </legend>
        <div class="eqLogicThumbnailContainer">
                      <div class="cursor eqLogicAction" data-action="add" style="text-align: center; background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >
            <i class="fa fa-plus-circle" style="font-size : 7em;color:#94ca02;"></i>
        <br>
        <span style="font-size : 1.1em;position:relative; top : 23px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;;color:#94ca02">Ajouter</span>
    </div>
         <?php
                foreach ($eqLogics as $eqLogic) {
                    $opacity = '';
                    if ($eqLogic->getIsEnable() != 1) {
                    $opacity = 'opacity:0.3;';
                    }
                    echo '<div class="eqLogicDisplayCard cursor" data-eqLogic_id="' . $eqLogic->getId() . '" style="text-align: center; background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;' . $opacity . '" >';
                    echo '<img src="plugins/porkfolio/core/template/images/porkfolio_icon.png" height="105" width="95" />';
                    echo "<br>";
                    echo '<span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;">' . $eqLogic->getHumanName(true, true) . '</span>';
                    echo '</div>';
                }
                ?>
            </div>
    </div>   

    <div class="col-lg-10 eqLogic" style="border-left: solid 1px #EEE; padding-left: 25px;display: none;">
        <form class="form-horizontal">
            <fieldset>
                <legend><i class="fa fa-arrow-circle-left eqLogicAction cursor" data-action="returnToThumbnailDisplay"></i> {{Général}}<i class='fa fa-cogs eqLogicAction pull-right cursor expertModeVisible' data-action='configure'></i></legend>
                <div class="form-group">
                    <label class="col-lg-2 control-label">{{Nom de l'équipement porkfolio}}</label>
                    <div class="col-lg-2">
                        <input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display : none;" />
                        <input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom de l'équipement porkfolio}}"/>
                    </div>
					<label class="col-lg-1 control-label" >{{Objet parent}}</label>
                    <div class="col-lg-2">
                        <select id="sel_object" class="eqLogicAttr form-control" data-l1key="object_id">
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
                    <label class="col-lg-2 control-label">{{Catégorie}}</label>
                    <div class="col-lg-6">
                        <?php
                        foreach (jeedom::getConfiguration('eqLogic:category') as $key => $value) {
                            echo '<label class="checkbox-inline">';
                            echo '<input type="checkbox" class="eqLogicAttr" data-l1key="category" data-l2key="' . $key . '" />' . $value['name'];
                            echo '</label>';
                        }
                        ?>

                    </div>
                </div>
                <div class="form-group">
                <label class="col-sm-2 control-label" ></label>
                <div class="col-sm-9">
                 <input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-label-text="{{Activer}}" data-l1key="isEnable" checked/>
                  <input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-label-text="{{Visible}}" data-l1key="isVisible" checked/>
                </div>
                </div>
                <legend><i class="fa fa-wrench"></i>  {{Configuration}}</legend>
                <div class="form-group">
                    <label class="col-lg-2 control-label">{{Numéro}}</label>
                    <div class="col-lg-4">
                        <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="porknumber" placeholder="{{Numéro de votre porkfolio si plusieurs, rien si vous en avez qu'un}}"/>
                    </div>
                </div>
			<legend><i class="fa fa-info"></i>  {{Informations}}</legend>
                
			<div class="form-group">
                    		<label class="col-md-2 control-label">{{Porkfolio Id}}</label>
                    		<div class="col-md-2">
                        	<input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="porkid" readonly/>
                    		</div>
							<label class="col-md-2 control-label">{{Porkfolio Name}}</label>
                    		<div class="col-md-2">
                        	<input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="porkname" readonly/>
                    		</div>							
            </div>
			<div class="form-group">
                    		<label class="col-md-2 control-label">{{Porkfolio Serial}}</label>
                    		<div class="col-md-2">
                        	<input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="porkserial" readonly/>
                    		</div>
							<label class="col-md-2 control-label">{{Porkfolio Mac}}</label>
                    		<div class="col-md-2">
                        	<input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="porkmac" readonly/>
                    		</div>							
            </div>  
			</fieldset>
		</form> 
        <legend><i class="fa fa-list-alt"></i>  {{Tableau de commandes}}</legend>
        <table id="table_cmd" class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th>{{Nom}}</th><th>{{Options}}</th><th>{{Action}}</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

        <form class="form-horizontal">
            <fieldset>
			    <div class="form-actions">
                    <a class="btn btn-danger eqLogicAction" data-action="remove"><i class="fa fa-minus-circle"></i> {{Supprimer}}</a>
                    <a class="btn btn-success eqLogicAction" data-action="save"><i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
                </div>
            </fieldset>
        </form>

    </div>
</div>

<?php include_file('desktop', 'porkfolio', 'js', 'porkfolio'); ?>
<?php include_file('core', 'plugin.template', 'js'); ?>
