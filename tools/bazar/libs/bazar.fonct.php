<?php

/*vim: set expandtab tabstop=4 shiftwidth=4: */

// +------------------------------------------------------------------------------------------------------+
// | PHP version 4.1                                                                                      |
// +------------------------------------------------------------------------------------------------------+
// | Copyright (C) 2004 Tela Botanica (accueil@tela-botanica.org)                                         |
// +------------------------------------------------------------------------------------------------------+
// | This library is free software; you can redistribute it and/or                                        |
// | modify it under the terms of the GNU Lesser General Public                                           |
// | License as published by the Free Software Foundation; either                                         |
// | version 2.1 of the License, or (at your option) any later version.                                   |
// |                                                                                                      |
// | This library is distributed in the hope that it will be useful,                                      |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of                                       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU                                    |
// | Lesser General Public License for more details.                                                      |
// |                                                                                                      |
// | You should have received a copy of the GNU Lesser General Public                                     |
// | License along with this library; if not, write to the Free Software                                  |
// | Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA                            |
// +------------------------------------------------------------------------------------------------------+
// CVS : $Id: bazar.fonct.php,v 1.10 2010/03/04 14:19:03 mrflos Exp $

/**
 * Fonctions du module bazar.
 *
 *
 *@author        Florian Schmitt <florian@outils-reseaux.org>
 *@author        Alexandre Granier <alexandre@tela-botanica.org>
 * Autres auteurs :
 *@copyright     Outils-Reseaux 2000-2010
 *
 *@version       $Revision: 1.10 $ $Date: 2010/03/04 14:19:03 $
 *  +------------------------------------------------------------------------------------------------------+
 */

// +------------------------------------------------------------------------------------------------------+
// |                                            ENTETE du PROGRAMME                                       |
// +------------------------------------------------------------------------------------------------------+

require_once BAZ_CHEMIN.'libs'.DIRECTORY_SEPARATOR.'formulaire'.DIRECTORY_SEPARATOR
.'formulaire.fonct.inc.php';


/** baz_afficher_menu() - Prepare les boutons du menu de bazar et renvoie le html
 * @return string HTML
 */
function baz_afficher_menu($menuitems)
{
    $res = '<div class="BAZ_menu">'."\n".'<ul class="nav nav-pills">'.
    "\n";

    // Gestion de la vue par defaut
    if (!isset($_GET[BAZ_VARIABLE_VOIR])) {
        $_GET[BAZ_VARIABLE_VOIR] = $GLOBALS['params']['vue'];
    }

    foreach ($menuitems as $menu) {
        if ($menu == strval(BAZ_VOIR_MES_FICHES)) {
            // Mes fiches
            $urlParams  = BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_MES_FICHES;
            $res .= '<li'.($_GET[BAZ_VARIABLE_VOIR] == BAZ_VOIR_MES_FICHES ?
                ' class="active"' : '').'>';
            $res .= '<a href="'.$GLOBALS['wiki']->href('', $GLOBALS['wiki']->getPageTag(), $urlParams).'">'
            ._t('BAZ_VOIR_VOS_FICHES').'</a>'."\n".'</li>'."\n";
        } elseif ($menu == strval(BAZ_VOIR_CONSULTER)) {
            //partie consultation d'annonces
            $urlParams  = BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_CONSULTER;
            $res .= '<li'.($_GET[BAZ_VARIABLE_VOIR] == BAZ_VOIR_CONSULTER ?
                ' class="active"' : '').'>';
            $res .= '<a href="'.$GLOBALS['wiki']->href('', $GLOBALS['wiki']->getPageTag(), $urlParams).'">'.
            _t('BAZ_CONSULTER').'</a>'."\n".'</li>'."\n";
        } elseif ($menu == strval(BAZ_VOIR_SAISIR)) {
            //partie saisie d'annonces
            $urlParams  = BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_SAISIR;
            $res .= '<li'.($_GET[BAZ_VARIABLE_VOIR] == BAZ_VOIR_SAISIR ?
                ' class="active"' : '').'>';
            $res .= '<a href="'.$GLOBALS['wiki']->href('', $GLOBALS['wiki']->getPageTag(), $urlParams).'">'.
            _t('BAZ_SAISIR').'</a>'."\n".'</li>'."\n";
        } elseif ($menu == strval(BAZ_VOIR_S_ABONNER)) {
            //partie abonnement aux annonces
            $urlParams  = BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_S_ABONNER;
            $res .= '<li'.($_GET[BAZ_VARIABLE_VOIR] == BAZ_VOIR_S_ABONNER ?
                ' class="active"' : '').'>';
            $res .= '<a href="'.$GLOBALS['wiki']->href('', $GLOBALS['wiki']->getPageTag(), $urlParams).'">'.
            _t('BAZ_S_ABONNER').'</a></li>'."\n";
        } elseif ($menu == strval(BAZ_VOIR_FORMULAIRE)) {
            //partie affichage formulaire
            $urlParams  = BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_FORMULAIRE;
            $res .= '<li'.($_GET[BAZ_VARIABLE_VOIR] == BAZ_VOIR_FORMULAIRE ?
                ' class="active"' : '').'>';
            $res .= '<a href="'.$GLOBALS['wiki']->href('', $GLOBALS['wiki']->getPageTag(), $urlParams).'">'.
            _t('BAZ_FORMULAIRE').'</a></li>'."\n";
        } elseif ($menu == strval(BAZ_VOIR_LISTES)) {
            //partie affichage listes
            $urlParams  = BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_LISTES;
            $res .= '<li'.($_GET[BAZ_VARIABLE_VOIR] == BAZ_VOIR_LISTES ?
                ' class="active"' : '').'>';
            $res .= '<a href="'.$GLOBALS['wiki']->href('', $GLOBALS['wiki']->getPageTag(), $urlParams).'">'.
            _t('BAZ_LISTES').'</a></li>'."\n";
        } elseif ($menu == strval(BAZ_VOIR_IMPORTER)) {
            //partie import
            $urlParams  = BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_IMPORTER;
            $res .= '<li'.($_GET[BAZ_VARIABLE_VOIR] == BAZ_VOIR_IMPORTER ?
                ' class="active"' : '').'>';
            $res .= '<a href="'.$GLOBALS['wiki']->href('', $GLOBALS['wiki']->getPageTag(), $urlParams).'">'.
            _t('BAZ_IMPORTER').'</a></li>'."\n";
        } elseif ($menu = strval(BAZ_VOIR_EXPORTER)) {
            //partie export
            $urlParams  = BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_EXPORTER;
            $res .= '<li'.($_GET[BAZ_VARIABLE_VOIR] == BAZ_VOIR_EXPORTER ?
                ' class="active"' : '').'>';
            $res .= '<a href="'.$GLOBALS['wiki']->href('', $GLOBALS['wiki']->getPageTag(), $urlParams).'">'.
            _t('BAZ_EXPORTER').'</a></li>'."\n";
        }
    }

    $res .= '</ul>'."\n".'</div>'."\n";

    return $res;
}

/** baz_afficher_liste_fiches_utilisateur () - Affiche la liste des fiches bazar d'un utilisateur
 * @return string HTML
 */
function baz_afficher_liste_fiches_utilisateur()
{
    $res = '';
    //$res .= '<h2 class="titre_mes_fiches">' . _t('BAZ_VOS_FICHES') . '</h2>' . "\n";
    $nomwiki = $GLOBALS['wiki']->getUser();

    //test si l'on est identifie pour voir les fiches
    if (baz_a_le_droit('voir_mes_fiches') && isset($nomwiki['name'])) {
        $tableau_dernieres_fiches = baz_requete_recherche_fiches(
            '',
            '',
            $GLOBALS['params']['idtypeannonce'],
            $GLOBALS['params']['categorienature'],
            1,
            $nomwiki['name'],
            10
        );
        $res .= exturl($tableau_dernieres_fiches, $GLOBALS['params'], false);
    } else {
        $res .= '<div class="alert alert-info">'."\n"
        .'<a data-dismiss="alert" class="close" type="button">&times;</a>'
        ._t('BAZ_IDENTIFIEZ_VOUS_POUR_VOIR_VOS_FICHES').'</div>'."\n";
    }
    $urlParams = BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_SAISIR;
    $res .= '<a class="btn btn-primary" href="'.$GLOBALS['wiki']->href('', $GLOBALS['wiki']->getPageTag(), $urlParams)
    .'" title="'._t('BAZ_SAISIR_UNE_NOUVELLE_FICHE')
    .'"><i class="glyphicon glyphicon-plus icon-plus icon-white"></i>&nbsp;'
    ._t('BAZ_SAISIR_UNE_NOUVELLE_FICHE').'</a></li></ul>';

    return $res;
}

/**
 * interface de choix des fiches a importer.
 */
function baz_afficher_formulaire_import()
{
    $output = '';
    if ($GLOBALS['wiki']->UserIsAdmin()) {
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        if (empty($id)) {
            $id = isset($_REQUEST['id_typeannonce']) ? $_REQUEST['id_typeannonce'] : '';
        }
        //on transforme en entier, pour eviter des attaques
        $id = (int)preg_replace('/[^\d]+/', '', $id);

        $urlParams = BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_IMPORTER;
        $output .= '<form method="post" action="'.$GLOBALS['wiki']->href('', $GLOBALS['wiki']->getPageTag(), $urlParams).'" '.
        'enctype="multipart/form-data" class="form-horizontal">'."\n";

        // le fichier cvs vient d'être téléchargé, on le traite
        if (isset($_POST['submit_file'])) {
            $row = 1;
            $val_formulaire = baz_valeurs_formulaire($id);

            // Recuperation champs de la fiche
            $tableau = $val_formulaire['template'];
            $alllists = array_change_key_case(baz_valeurs_liste(), CASE_LOWER);
            $nb = 0;
            $nom_champ = array();
            $type_champ = array();
            foreach ($tableau as $ligne) {
                if ($ligne[0] != 'labelhtml') {
                    if ($ligne[0] == 'radio' || $ligne[0] == 'liste' || $ligne[0] == 'checkbox' || $ligne[0] == 'listefiche' || $ligne[0] == 'checkboxfiche') {
                        $nom_champ[] =
                        $ligne[0].$ligne[1].$ligne[6];
                        $type_champ[] =
                        $ligne[0];
                        $idliste_champ[$ligne[0].$ligne[1].$ligne[6]] =
                        $ligne[1];
                    } elseif ($ligne[0] == 'carte_google') {
                        $nom_champ[] = $ligne[1];
                        $nom_champ[] = $ligne[2];
                        $type_champ[] = $ligne[0];
                        $type_champ[] = $ligne[0];
                        ++$nb;
                    } elseif ($ligne[0] == 'utilisateur_wikini') {
                        $nom_champ[] = 'nomwiki';
                        $nom_champ[] = 'mot_de_passe_wikini';
                        $type_champ[] = $ligne[0];
                        $type_champ[] = $ligne[0];
                        ++$nb;
                    } elseif ($ligne[0] == 'titre') {
                        $nom_champ[] = 'bf_titre';
                        $type_champ[] = $ligne[0];
                    } elseif ($ligne[0] == 'inscriptionliste') {
                        $nom_champ[] = str_replace(array('@', '.'), array('',
                            '', ), $ligne[1]);
                        $type_champ[] = $ligne[0];
                    } elseif ($ligne[0] == 'image' || $ligne[0] == 'fichier') {
                        $nom_champ[] = $ligne[0].$ligne[1];
                        $type_champ[] = $ligne[0];
                    } else {
                        $nom_champ[] = $ligne[1];
                        $type_champ[] = $ligne[0];
                    }
                    ++$nb;
                }
            }

            if ((!empty($_FILES['fileimport'])) &&
                ($_FILES['fileimport']['error'] == 0)) {
                //Check if the file is csv
                $filename = basename($_FILES['fileimport']['name']);
                $ext = substr($filename, strrpos($filename, '.') + 1);
                if ($ext == 'csv') {
                    $newname = BAZ_CHEMIN_UPLOAD.$filename;
                    //verification de la presence de ce fichier, s'il existe deja , on le supprime
                    move_uploaded_file(
                        $_FILES['fileimport']['tmp_name'],
                        $newname
                    );
                    $erreur = false;
                    $outputright = '';
                    $outputerror = '';
                    if (($handle = fopen($newname, 'r')) !== false) {
                        while (($data = fgetcsv($handle, 0, ',')) !== false) {
                            $valeur = array();
                            $geolocalisation = false;
                            $bf_latitude = false;
                            $bf_longitude = false;
                            $erreur = false;
                            $errormsg = array();
                            $num = count($data);
                            $dateincvs = false;
                            // la premiere ligne contient les titres des colonnes
                            if ($row == 1) {
                                // on teste s'il faut ignorer les 2 premieres colonnes
                                if ($data[0] == 'datetime_create' and $data[1] == 'datetime_latest') {
                                    $startparsing = 2;
                                    // on ajoute 2 champs vides pour les dates
                                    array_unshift($nom_champ, 'datetime_create', 'datetime_latest');
                                    array_unshift($type_champ, 'datetime_create', 'datetime_latest');
                                } else {
                                    $startparsing = 0;
                                }
                            } elseif ($row > 1) {
                                for ($c = $startparsing; $c < $num; ++$c) {
                                    if (isset($nom_champ[$c])) {
                                        if (YW_CHARSET != 'UTF-8') {
                                            $valeur[$nom_champ[$c]] =
                                            utf8_decode($data[$c], ENT_QUOTES, 'ISO-8859-15');
                                        } else {
                                            $valeur[$nom_champ[$c]] = $data[$c];
                                        }
                                        $valeur[$nom_champ[$c]] = str_replace(
                                            array(
                                                '&sbquo;', '&fnof;', '&bdquo;',
                                                '&hellip;', '&dagger;', '&Dagger;',
                                                '&circ;', '&permil;', '&Scaron;',
                                                '&lsaquo;', '&OElig;', '&lsquo;',
                                                '&rsquo;', '&ldquo;', '&rdquo;',
                                                '&bull;', '&ndash;', '&mdash;',
                                                '&tilde;', '&trade;', '&scaron;',
                                                '&rsaquo;', '&oelig;', '&Yuml;',
                                            ),
                                            array(chr(130), chr(131), chr(132),
                                                chr(133), chr(134), chr(135),
                                                chr(136),
                                                chr(137), chr(138), chr(139),
                                                chr(140), chr(145), chr(146),
                                                chr(147),
                                                chr(148), chr(149), chr(150),
                                                chr(151), chr(152), chr(153),
                                                chr(154),
                                                chr(155), chr(156), chr(159),
                                            ),
                                            $valeur[$nom_champ[$c]]
                                        );
                                        if ($nom_champ[$c] == 'bf_latitude' &&
                                            !empty($data[$c])) {
                                            $bf_latitude = $data[$c];
                                            $geolocalisation = true;
                                        }
                                        if ($nom_champ[$c] == 'bf_longitude' &&
                                            !empty($data[$c])) {
                                            $bf_longitude = $data[$c];
                                            $geolocalisation = true;
                                        }

                                        // recuperer les id pour les listes et checkbox plutot que leur labels
                                        if (($type_champ[$c] == 'checkbox' ||
                                            $type_champ[$c] == 'liste') &&
                                            isset($data[$c]) &&
                                            !empty($data[$c])) {
                                            if ($type_champ[$c] == 'liste') {
                                                $idval = array_search(
                                                    $data[$c],
                                                    $alllists[strtolower($idliste_champ[$nom_champ[$c]])]['label']
                                                );
																if ( (! $idval) && ( is_numeric($data[$c])) ) {
																		$idval = $data[$c] ;
																	}
                                            } elseif ($type_champ[$c] ==
                                                'checkbox') {
                                                $tab_chkb = explode(',', $data[$c]);
                                                $tab_chkb = array_map('trim', $tab_chkb);
																$k = strtolower($idliste_champ[$nom_champ[$c]]);
                                                $refList = $alllists[$k]['label'];
                                                $tab_id = array();
                                                foreach ($tab_chkb as $value) {
																	// dirty patch to permits "index" instead of "label"
                                                    // https://framagit.org/Artefacts/ATable-guide-web/issues/30
                                                    if( is_numeric($value) )
                                                        $tab_id[] = $value ;
                                                    else
                                                        $tab_id[] = array_search( $value, $refList );
                                                }
                                                $idval = implode(',', $tab_id);
                                            }
                                            $valeur[$nom_champ[$c]] = $idval;
                                        }

                                        // traitement des images (doivent être présentes dans le dossier files du wiki)
                                        if (($type_champ[$c]) == 'image' &&
                                            isset($data[$c]) && !empty($data[$c])) {
                                            $imageorig =
                                            trim($valeur[$nom_champ[$c]]);

                                            //on enleve les accents sur les noms de fichiers, et les espaces
                                            $nomimage =
                                            preg_replace(
                                                '/&([a-z])[a-z]+;/i',
                                                '$1',
                                                $imageorig
                                            );
                                            $nomimage =
                                            str_replace(' ', '_', $nomimage);
                                            unset($valeur['bf_image']);
                                            $valeur['image'.$nom_champ[$c]] =
                                            $nomimage;
                                            if (file_exists(BAZ_CHEMIN_UPLOAD.
                                                $imageorig)) {
                                                if (preg_match('/(gif|jpeg|png|jpg)$/i', $nomimage)) {
                                                    $chemin_destination =
                                                    BAZ_CHEMIN_UPLOAD.$nomimage;

                                                    //verification de la presence de ce fichier
                                                    if (!file_exists($chemin_destination)) {
                                                        rename(
                                                            BAZ_CHEMIN_UPLOAD.
                                                            $imageorig,
                                                            $chemin_destination
                                                        );
                                                        chmod($chemin_destination, 0755);
                                                    }
                                                } else {
                                                    $errormsg[] =

                                                    _t('BAZ_BAD_IMAGE_FILE_EXTENSION');
                                                    $erreur = true;
                                                }
                                            } else {
                                                $errormsg[] =
                                                _t('BAZ_IMAGE_FILE_NOT_FOUND').
                                                ' : '.$imageorig;
                                                $erreur = true;
                                            }
                                        }

                                        if ($geolocalisation) {
                                            $valeur['carte_google'] =
                                            $bf_latitude.'|'.$bf_longitude;
                                        }
                                    }
                                }
                                $valeur['id_fiche'] =
                                genere_nom_wiki($valeur['bf_titre']);
                                $valeur['id_typeannonce'] = $id;
                                $valeur['date_creation_fiche'] =
                                date('Y-m-d H:i:s', time());
                                $valeur['date_maj_fiche'] =
                                date('Y-m-d H:i:s', time());
                                if ($GLOBALS['wiki']->UserIsAdmin()) {
                                    $valeur['statut_fiche'] = 1;
                                } else {
                                    $valeur['statut_fiche'] =
                                    $GLOBALS['wiki']->config['BAZ_ETAT_VALIDATION'];
                                }
                                $user = $GLOBALS['wiki']->GetUser();
                                if ($user) {
                                    $valeur['createur'] = $user['name'];
                                } else {
                                    $valeur['createur'] = _t('BAZ_ANONYME');
                                }
                                $valeur['date_debut_validite_fiche'] =
                                date('Y-m-d', time());
                                $valeur['date_fin_validite_fiche'] =
                                '0000-00-00';

                                if (count($errormsg) > 0) {
                                    $outputerror .=
                                    '<label>
                                            <input type="checkbox" disabled> '
                                    .$valeur['bf_titre'].

                                    '
                                            </label>
                                            <a class="btn-mini btn-xs btn btn-default" data-target="#collapse'

                                    .$valeur['id_fiche'].
                                    '" data-toggle="collapse">'

                                    .

                                    '<i class="glyphicon glyphicon-eye-open icon-eye-open icon-white"></i> '

                                    ._t('BAZ_SEE_ENTRY').'</a>
                                <div class="panel panel-danger">
                                    <div id="collapse'.$valeur['id_fiche'].'" class="panel-collapse collapse">
                                      <div class="panel-body">
                                        <div class="alert alert-danger">'.
                                    implode('<br>', $errormsg).'</div>'.
                                    baz_voir_fiche(0, $valeur).'
                                      </div>
                                    </div>
                                  </div>'."\n";
                                } else {
                                    $outputright .=

                                    '<label>
                                            <input type="checkbox" name="importfiche['.$valeur['id_fiche'].']" value=\''

                                    .base64_encode(serialize($valeur)).
                                    '\'> '.$valeur['bf_titre'].

                                    '
                                            </label>
                                            <a class="btn-mini btn-xs btn btn-default" data-target="#collapse'.

                                    $valeur['id_fiche'].
                                    '" data-toggle="collapse">'

                                    .

                                    '<i class="glyphicon glyphicon-eye-open icon-eye-open icon-white"></i> '
                                    ._t('BAZ_SEE_ENTRY').'</a>
                                    <div class="panel panel-default">
                                        <div id="collapse'.
                                    $valeur['id_fiche'].'" class="panel-collapse collapse">
                                          <div class="panel-body">'.
                                    baz_voir_fiche(0, $valeur).'
                                          </div>
                                        </div>
                                      </div>'."\n";
                                }
                            }
                            ++$row;
                        }
                        fclose($handle);
                    }

                    $output .=

                    '<div class="checkbox">
                                <label class="checkbox">
                                    <input data-target="#accordion-import" type="checkbox" class="selectall"> '

                    ._t('BAZ_SELECT_ALL').

                    '
                                </label>
                            </div>
                            <div class="panel-group accordion-group no-dblclick" id="accordion-import">'."\n".
                    $outputerror.$outputright."\n".
                    '</div><!-- /#accordion-import -->'."\n".

                    '<div class="checkbox">
                                <label class="checkbox">
                                    <input data-target="#accordion-import" type="checkbox" class="selectall"> '
                    ._t('BAZ_SELECT_ALL').'
                                </label>
                            </div>'."\n".

                    '<input type="hidden" value="'.$id.
                    '" name="id" />'."\n".
                    '<button class="btn btn-primary" type="submit">'
                    ._t('BAZ_IMPORT_SELECTION').'</button>'."\n";
                }
            }
        } elseif (isset($_POST['importfiche'])) {
            if (!isset($GLOBALS['importdone'])) {
                // Pour les traitements particulier lors de l import
                $GLOBALS['_BAZAR_']['provenance'] = 'import';
    
                // des fiches ont été sélectionnées pour l'import
                $val_formulaire = baz_valeurs_formulaire($id);
                $importlist = '';
                $nb = 0;
                foreach ($_POST['importfiche'] as $valeur) {
                    $valeur = unserialize(base64_decode($valeur));
                    $valeur['id_fiche'] = genere_nom_wiki($valeur['bf_titre']);
                    $valeur['id_typeannonce'] = $id;
                    $valeur = array_map('strval', $valeur);
                    baz_insertion_fiche($valeur);
                    ++$nb;
                    $importlist .=
                    ' '.$nb.') [['.$valeur['id_fiche'].' '.
                    $valeur['bf_titre'].']]'."\n";
                }
                $output .=
                '<div class="alert alert-success">'.
                _t('BAZ_NOMBRE_FICHE_IMPORTE').' '.$nb.'</div>'."\n".
                $GLOBALS['wiki']->Format($importlist);
                $GLOBALS['importdone'] = true;
            }
        } else {
            // Affichage par defaut
            //On choisit un type de fiches pour parser le csv en consequence
            //requete pour obtenir l'id et le label des types d'annonces
            $resultat = baz_valeurs_formulaire('', $GLOBALS['params']['categorienature']);

            //s'il y a plus d'un choix possible, on propose
            if (count($resultat) >= 1) {
                $output .=
                '<div class="control-group form-group">'."\n".
                '<label class="control-label col-sm-3">'."\n"

                ._t('BAZ_TYPE_FICHE_IMPORT').' :</label>'."\n".
                '<div class="controls col-sm-9">';
                $output .= '<select class="form-control" name="id" '
                .'onchange="javascript:this.form.submit();">'."\n";

                //si l'on n'a pas deja choisi de fiche, on demarre sur l'option CHOISIR, vide
                if ($id == '') {
                    $output .=
                    '<option value="" selected="selected">'.
                    _t('BAZ_CHOISIR').'</option>'."\n";
                }

                //on dresse la liste de types de fiches
                foreach ($resultat as $ligne) {
                    $output .= '<option value="'.$ligne['bn_id_nature']
                    .'"'
                    .($id == $ligne['bn_id_nature'] ?
                        ' selected="selected"' : '')
                    .'>'.$ligne['bn_label_nature'].'</option>'."\n";
                }
                $output .= '</select>'."\n".'</div>'."\n".'</div>'.
                "\n";
            } else {
                $output .= _t('BAZ_PAS_DE_FORMULAIRES_TROUVES')."\n";
            }

            if ($id != '') {
                $val_formulaire = baz_valeurs_formulaire($id);
                $output .=
                '<div class="control-group form-group">'."\n".
                '<label class="control-label col-sm-3">'."\n"
                ._t('BAZ_FICHIER_CSV_A_IMPORTER').' :</label>'."\n".
                '<div class="controls col-sm-9">';
                $output .=
                '<input type="file" name="fileimport" id="idfileimport" />'.
                "\n".'</div>'."\n".'</div>'."\n";
                $output .= '<div class="control-group form-group">'."\n"
                .'<label class="control-label col-sm-3"></label>'."\n"
                .'<div class="controls col-sm-9">'."\n".
                '<input name="submit_file" type="submit" value="'
                ._t('BAZ_IMPORTER_CE_FICHIER').
                '" class="btn btn-primary" />'."\n".'</div>'."\n".
                '</div>'."\n";
                $output .= '<div class="alert alert-info">'."\n"
                .'<a data-dismiss="alert" class="close" type="button">&times;</a>'."\n"
                ._t('BAZ_ENCODAGE_CSV')."\n".'</div>'."\n";

                // TODO reprendre code ci apres
                //on parcourt le template du type de fiche pour fabriquer un csv pour l'exemple
                $tableau = $val_formulaire['template'];
                $nb = 0;
                $csv = '';
                foreach ($tableau as $ligne) {
                    if ($ligne[0] != 'labelhtml') {
                        if ($ligne[0] == 'liste' || $ligne[0] == 'checkbox' ||
                            $ligne[0] == 'listefiche' || $ligne[0] ==
                            'checkboxfiche') {
                            $csv .= _convert(
                                '"'.str_replace('"', '""', $ligne[2]).((isset($ligne[9]) && $ligne[9] == 1) ? ' *' : '').'",',
                                YW_CHARSET
                            );
                        } elseif ($ligne[0] == 'carte_google') {
                            // cas de la carto
                            $csv .= _convert(
                                '"'.str_replace('"', '""', $ligne[1]).((isset($ligne[4]) && $ligne[4] == 1) ? ' *' : '').'",',
                                YW_CHARSET
                            );
                            $csv .= _convert(
                                '"'.str_replace('"', '""', $ligne[2]).((isset($ligne[4]) && $ligne[4] == 1) ? ' *' : '').'",',
                                YW_CHARSET
                            );
                            ++$nb;
                        } elseif ($ligne[0] == 'titre') {
                            // Champ titre aggregeant plusieurs champs
                            $csv .= _convert(
                                '"'.str_replace('"', '""', 'Titre calculé').((isset($ligne[9]) && $ligne[9] == 1) ? ' *' : '').'",',
                                YW_CHARSET
                            );
                        } elseif ($ligne[0] == 'utilisateur_wikini') {
                            // utilisateur et mot de passe
                            $csv .= _convert(
                                '"'.str_replace('"', '""', 'NomWiki').((isset($ligne[9]) && $ligne[9] == 1) ? ' *' : '').'",',
                                YW_CHARSET
                            );
                            $csv .= _convert(
                                '"'.str_replace('"', '""', 'Mot de passe').((isset($ligne[9]) && $ligne[9] == 1) ? ' *' : '').'",',
                                YW_CHARSET
                            );
                            ++$nb;
                        } elseif ($ligne[0] == 'inscriptionliste') {
                            // Nom de la liste et etat de l'abonnement
                            $csv .= _convert(
                                '"'.str_replace('"', '""', $ligne[1]).((isset($ligne[9]) && $ligne[9] == 1) ? ' *' : '').'",',
                                YW_CHARSET
                            );
                        } else {
                            $csv .= _convert(
                                '"'.str_replace('"', '""', $ligne[2]).((isset($ligne[9]) && $ligne[9] == 1) ? ' *': '').'",',
                                YW_CHARSET
                            );
                        }
                        ++$nb;
                    }
                }
                $csv = substr(trim($csv), 0, -1)."\r\n";

                for ($i = 1; $i < 4; ++$i) {
                    for ($j = 1; $j < ($nb + 1); ++$j) {
                        $csv .= '"ligne '.$i.' - champ '.$j.'", ';
                    }
                    $csv = substr(trim($csv), 0, -1)."\r\n";
                }
                $output .=
                '<em>'._t('BAZ_EXEMPLE_FICHIER_CSV').
                $val_formulaire['bn_label_nature'].'</em>'."\n";
                $output .= '<pre class="precsv">'."\n".$csv."\n".
                '</pre>'."\n";

                //on genere un fichier exemple pour faciliter le travail d'import
                $chemin_destination =
                BAZ_CHEMIN_UPLOAD.'bazar-import-'.$id.'.csv';

                //verification de la presence de ce fichier, s'il existe deja , on le supprime
                if (file_exists($chemin_destination)) {
                    unlink($chemin_destination);
                }
                $fp = fopen($chemin_destination, 'w');
                fwrite($fp, $csv);
                fclose($fp);
                chmod($chemin_destination, 0755);

                //on cree le lien vers ce fichier
                $output .=
                '<a href="'.$chemin_destination.
                '" class="link-csv-file" title="'
                ._t('BAZ_TELECHARGER_FICHIER_IMPORT_CSV').'">'
                ._t('BAZ_TELECHARGER_FICHIER_IMPORT_CSV').'</a>'."\n";
            }
        }
        $output .= '</form>'."\n";
    } else {
        $output .=
        '<div class="alert alert-error alert-danger">'.
        _t('BAZ_NEED_ADMIN_RIGHTS').'.</div>'."\n";
    }

    return $output;
}

/**
 * interface de choix des fiches a exporter.
 */
function baz_afficher_formulaire_export()
{
    $output = '';

    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : (isset($_POST['id_typeannonce']) ? $_POST['id_typeannonce'] : '');
    //on transforme en entier, pour eviter des attaques
    $id = (int)preg_replace('/[^\d]+/', '', $id);

    //On choisit un type de fiches pour parser le csv en consequence
    $resultat = baz_valeurs_formulaire('', $GLOBALS['params']['categorienature']);

    $output .=
    '<form method="post" class="form-horizontal" action="'.$GLOBALS['wiki']
        ->Href()
    .(($GLOBALS['wiki']->GetMethod() != 'show') ?
        '/'.$GLOBALS['wiki']->GetMethod() :
        '&amp;'.BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_EXPORTER).'">'."\n";

    //s'il y a plus d'un choix possible, on propose
    if (count($resultat) >= 1) {
        $output .=
        '<div class="row row-fluid">'."\n".
        '<div class="control-group form-group">'."\n"

        .'<label class="control-label col-sm-3">'."\n".
        _t('BAZ_TYPE_FICHE_EXPORT').' :</label>'."\n"
        .'<div class="controls col-sm-9">';
        $output .=

        '<select class="form-control" name="id_typeannonce" onchange="javascript:this.form.submit();">'."\n";

        //si l'on n'a pas deja choisit de fiche, on demarre sur l'option CHOISIR, vide
        if (!isset($_POST['id_typeannonce'])) {
            $output .=
            '<option value="" selected="selected">'._t('BAZ_CHOISIR').
            '</option>'."\n";
        }

        //on dresse la liste de types de fiches
        foreach ($resultat as $ligne) {
            $output .= '<option value="'.$ligne['bn_id_nature'].'"'
            .(($id == $ligne['bn_id_nature']) ?
                ' selected="selected"' : '').'>'
            .$ligne['bn_label_nature'].'</option>'."\n";
        }
        $output .= '</select>'."\n".'</div>'."\n".'</div>'."\n";
    } else {
        //sinon c'est vide
        $output .=
        '<div class="alert alert-danger">'.
        _t('BAZ_PAS_DE_FORMULAIRES_TROUVES').'</div>'."\n";
    }
    $output .= '</div> <!-- /.row -->'."\n".'</form>'."\n";

    if ($id == '') {
        return $output;
    }

    $val_formulaire = baz_valeurs_formulaire($id);

    //on parcourt le template du type de fiche pour fabriquer un csv pour l'exemple
    $tableau = $val_formulaire['template'];
    $nb = 0;
    $csv = '';
    $tab_champs = array();

    foreach ($tableau as $ligne) {
        if ($ligne[0] != 'labelhtml') {
            // listes
            if ($ligne[0] == 'liste' || $ligne[0] == 'checkbox'
                || $ligne[0] == 'listefiche' || $ligne[0] ==
                'checkboxfiche') {
                $tab_champs[] = $ligne[0].'|'.$ligne[1].'|'.
                $ligne[6];
                $csv .= '"'.str_replace('"', '""', $ligne[2])
                .((isset($ligne[9]) && $ligne[9] == 1) ? ' *' : '').
                '",';
            } elseif ($ligne[0] == 'image' || $ligne[0] == 'fichier') {
                // image et fichiers
                $tab_champs[] = $ligne[0].$ligne[1];
                $csv .= '"'.str_replace('"', '""', $ligne[2])
                .((isset($ligne[9]) && $ligne[9] == 1) ? ' *' : '').
                '",';
            } elseif ($ligne[0] == 'carte_google') {
                // cas de la carto
                $tab_champs[] = $ligne[1];
                // bf_latitude
                $tab_champs[] = $ligne[2];
                // bf_longitude
                $csv .= '"'.str_replace('"', '""', $ligne[1])
                .((isset($ligne[4]) && $ligne[4] == 1) ? ' *' : '').
                '",';
                $csv .= '"'.str_replace('"', '""', $ligne[2])
                .((isset($ligne[4]) && $ligne[4] == 1) ? ' *' : '').
                '",';
            } elseif ($ligne[0] == 'titre') {
                // Champ titre aggregeant plusieurs champs
                $tab_champs[] = 'bf_titre';
                $csv .= '"'.str_replace('"', '""', 'Titre calculé')
                .((isset($ligne[9]) && $ligne[9] == 1) ? ' *' : '').
                '",';
            } elseif ($ligne[0] == 'utilisateur_wikini') {
                // Champ titre aggregeant plusieurs champs
                $tab_champs[] = 'nomwiki';
                $tab_champs[] = 'mot_de_passe_wikini';
                $csv .= '"'.str_replace('"', '""', 'NomWiki')
                .((isset($ligne[9]) && $ligne[9] == 1) ? ' *' : '').
                '",';
                $csv .= '"'.str_replace('"', '""', 'Mot de passe')
                .((isset($ligne[9]) && $ligne[9] == 1) ? ' *' : '').
                '",';
            } elseif ($ligne[0] == 'inscriptionliste') {
                // Nom de la liste et etat de l'abonnement
                $tab_champs[] = str_replace(array('@', '.'), array('',
                    '', ), $ligne[1]);
                // nom de la liste
                $csv .= '"'.str_replace('"', '""', $ligne[1])
                .((isset($ligne[9]) && $ligne[9] == 1) ? ' *' : '').
                '",';
            } else {
                $tab_champs[] = $ligne[1];
                $csv .= '"'.str_replace('"', '""', $ligne[2])
                .((isset($ligne[9]) && $ligne[9] == 1) ? ' *' : '').
                '",';
            }
            ++$nb;
        }
    }

    // CSV file headers
    //$csv = substr(trim($csv), 0, -1)."\r\n";
    $csv = '"datetime_create","datetime_latest",'.substr(trim($csv), 0, -1)."\n";

    // chaine de recherche
    $q = '';
    if (isset($_GET['q']) and !empty($_GET['q'])) {
        $q = $_GET['q'];
    }

    // TODO : gerer les queries
    $query = '';

    //on recupere toutes les fiches du type choisi et on les met au format csv
    $tableau_fiches = baz_requete_recherche_fiches(
        $query,
        'alphabetique',
        $id,
        '',
        1,
        '',
        '',
        true,
        $q
    );
    $total = count($tableau_fiches);
    foreach ($tableau_fiches as $fiche) {
        // create date and latest date
        $fiche_time_create = date_create_from_format('Y-m-d H:i:s', $GLOBALS['wiki']->GetPageCreateTime($fiche['tag']));
        $fiche_time_latest = date_create_from_format('Y-m-d H:i:s', $fiche['time']);

        $tab_valeurs = json_decode($fiche['body'], true);
        $tab_csv = array();

        foreach ($tab_champs as $index) {
            $tabindex = explode('|', $index);
            $index = str_replace('|', '', $index);

            //ces types de champs necessitent un traitement particulier
            if ($tabindex[0] == 'liste' || $tabindex[0] == 'checkbox'
                || $tabindex[0] == 'listefiche' || $tabindex[0] ==
                'checkboxfiche') {
                // ???  FIXME ?
                $toto = 'dummy';
                $html = $tabindex[0](
                    $toto,
                    array(
                        0 => $tabindex[0],
                        1 => $tabindex[1],
                        2 => '',
                        6 => $tabindex[2],
                    ),
                    'html',
                    array($index => isset($tab_valeurs[$index]) ?
                        $tab_valeurs[$index] : '', )
                );
                $tabhtml = explode('</span>', $html);
                $tab_valeurs[$index] = isset($tabhtml[1]) ?
                html_entity_decode(trim(strip_tags($tabhtml[1]))) : '';
            }

            // si la valeur existe, on l'affiche
            if (isset($tab_valeurs[$index])) {
                if ($index == 'mot_de_passe_wikini') {
                    $tab_valeurs[$index] = md5($tab_valeurs[$index]);
                }
                $tab_csv[] = html_entity_decode(
                    '"'.str_replace('"', '""', $tab_valeurs[$index]).'"'
                );
            } else {
                $tab_csv[] = '';
            }
        }

        //$csv .= implode(',', $tab_csv)."\r\n";
        $csv.= date_format($fiche_time_create, 'd/m/Y H:i:s')
            .','.date_format($fiche_time_latest, 'd/m/Y H:i:s')
            .','.implode(',', $tab_csv)."\n";
    }

    //$csv = _convert( $csv );
    $output .= '<em>'._t('BAZ_VISUALISATION_FICHIER_CSV_A_EXPORTER')

    .$val_formulaire['bn_label_nature'].' - '._t('BAZ_TOTAL_FICHES')
    .' : '.$total.'</em>'."\n";
    $output .= '<pre class="precsv">'."\n".$csv."\n".'</pre>'.
    "\n";

    //on genere le fichier
    $chemin_destination =
    BAZ_CHEMIN_UPLOAD.'bazar-export-'.$id.'.csv';

    //verification de la presence de ce fichier, s'il existe deja, on le supprime
    if (file_exists($chemin_destination)) {
        unlink($chemin_destination);
    }
    $fp = fopen($chemin_destination, 'w');
    fwrite($fp, $csv);
    fclose($fp);
    chmod($chemin_destination, 0755);

    //on cree le lien vers ce fichier
    $output .=
    '<a href="'.$chemin_destination.'" class="btn btn-xl btn-primary" title="'
    ._t('BAZ_TELECHARGER_FICHIER_EXPORT_CSV').'"><i class="glyphicon glyphicon-download"></i> '.
    _t('BAZ_TELECHARGER_FICHIER_EXPORT_CSV').'</a>'."\n";

    return $output;
}

/** baz_formulaire() - Renvoie le formulaire pour les saisies ou modification des fiches
 * @param   string  action du formulaire :
 *  - soit formulaire de saisie
 *  - soit sauvegarde dans la base de donnees
 *  - soit formulaire de modification
 *  - soit modification de la base de donnees
 * @param   string  url de renvois du formulaire (facultatif)
 * @param   array   valeurs de la fiche en cas de modification (facultatif)
 *
 * @return string HTML
 */
function baz_formulaire($mode, $url = '', $valeurs = '')
{
    $res = '';

    if ($url == '') {
        $urlParams = BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_SAISIR;
        $id = isset($_POST['id_typeannonce']) ? $_POST['id_typeannonce'] : '';
        if (empty($id)) {
            $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        }
        //Definir le lien du formulaire en fonction du mode de formulaire choisi
        if ($mode == BAZ_CHOISIR_TYPE_FICHE) {
            if ($GLOBALS['params']['vue'] == BAZ_VOIR_SAISIR && !empty($id)) {
                $urlParams .= '&'.BAZ_VARIABLE_ACTION.'='.BAZ_ACTION_NOUVEAU_V;
            } else {
                $urlParams .= '&'.BAZ_VARIABLE_ACTION.'='.BAZ_ACTION_NOUVEAU;
            }
        }
        if ($mode == BAZ_ACTION_NOUVEAU) {
            if (isset($id)) {
                if (!isset($_POST['bf_titre'])
                    || (!isset($_POST['accept_condition']) &&
                        $GLOBALS['_BAZAR_']['condition'] != null)) {
                    $urlParams .= '&'.BAZ_VARIABLE_ACTION.'='.BAZ_ACTION_NOUVEAU;
                } else {
                    $urlParams .= '&'.BAZ_VARIABLE_ACTION.'='.BAZ_ACTION_NOUVEAU_V;
                }
            } else {
                $mode = BAZ_CHOISIR_TYPE_FICHE;
            }
        }
        if ($mode == BAZ_ACTION_MODIFIER) {
            if (!isset($_POST['bf_titre'])
                || (!isset($_POST['accept_condition']) &&
                    $GLOBALS['_BAZAR_']['condition'] != null)) {
                $urlParams .= '&'.BAZ_VARIABLE_ACTION.'='.BAZ_ACTION_MODIFIER;
            } else {
                $urlParams .= '&'.BAZ_VARIABLE_ACTION.'='.BAZ_ACTION_MODIFIER_V;
            }
            $urlParams .= '&id_fiche='.$valeurs['id_fiche'];
        }
        if ($mode == BAZ_ACTION_MODIFIER_V) {
            $urlParams .= '&'.BAZ_VARIABLE_ACTION.'='.BAZ_ACTION_MODIFIER_V;
            $urlParams .= '&id_fiche='.$valeurs['id_fiche'];
        }
    }

    //------------------------------------------------------------------------------------------------
    // CHOIX DU TYPE DE FICHE
    //------------------------------------------------------------------------------------------------
    if ($mode == BAZ_CHOISIR_TYPE_FICHE) {
        if (!empty($id)) {
            $GLOBALS['params']['idtypeannonce'] = $id;
            $mode = BAZ_ACTION_NOUVEAU;
        } elseif (is_array($GLOBALS['params']['idtypeannonce']) && count($GLOBALS['params']['idtypeannonce']) == 1) {
            $GLOBALS['params']['idtypeannonce'] = $GLOBALS['params']['idtypeannonce'][0];
            $mode = BAZ_ACTION_NOUVEAU;
        } else {
            $resultat = array();

            $tabform = baz_valeurs_formulaire(
                $GLOBALS['params']['idtypeannonce'],
                $GLOBALS['params']['categorienature']
            );
            if (is_array($tabform)) {
                foreach ($tabform as $key => $value) {
                    $resultat[$value['bn_id_nature']] = $value;
                }
            }
            if (count($resultat) == 0) {
                $res .= '<div class="alert alert-info">'._t('BAZ_NO_FORMS_FOUND').
                '.</div>'."\n";
            } elseif (count($resultat) == 1) {
                $ligne = reset($resultat);
                $id = $ligne['bn_id_nature'];
                $GLOBALS['params']['idtypeannonce'] = $ligne['bn_id_nature'];
                $mode = BAZ_ACTION_NOUVEAU;
                //on remplace l'attribut action du formulaire par l'action adequate
                $urlParams = BAZ_VARIABLE_ACTION.'='.BAZ_ACTION_NOUVEAU_V;
                $formurl = $GLOBALS['wiki']->href('', $GLOBALS['wiki']->getPageTag(), $urlParams);
            } else {
                $res .= '<table id="add-entry-table" class="bazar-table table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>'._t('BAZ_FORMULAIRE').'</th>
                            <th style="width:220px;">'._t('BAZ_ACTIONS').'</th>
                        </tr>
                    </thead>
                    <tbody>'."\n";
                foreach ($resultat as $ligne) {
                    $newurl = $GLOBALS['wiki']->href(
                        '',
                        $GLOBALS['wiki']->GetPageTag(),
                        BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_SAISIR.'&amp;'.
                        BAZ_VARIABLE_ACTION.'='.BAZ_ACTION_NOUVEAU
                        .'&amp;id='.$ligne['bn_id_nature']
                    );
                    $res
                    .= '<tr>
                            <td>
                                <strong>'.$ligne['bn_label_nature'].
                    '</strong>'."\n"
                    .(!empty($ligne['bn_description']) ?
                        '<br>'.$ligne['bn_description'] :
                        '').'
                            </td>
                            <td>
                            <a class="btn btn-mini btn-xs btn-primary" href="'
                            .$newurl.'">'

                            .'<i class="glyphicon glyphicon-plus icon-plus"></i> '
                            ._t('BAZ_SAISIR_UNE_NOUVELLE_FICHE').'</a>&nbsp;&nbsp;'."\n"
                            .'</td>
                        </tr>';
                }
                $res .= '</tbody>
                </table>'."\n";
            }
        }
    }
    // test si on est dans une iframe
    $iframe = testUrlInIframe();

    //------------------------------------------------------------------------------------------------
    // AFFICHAGE DU FORMULAIRE CORRESPONDANT AU TYPE DE FICHE CHOISI PAR L'UTILISATEUR
    //------------------------------------------------------------------------------------------------
    if ($mode == BAZ_ACTION_NOUVEAU) {
        // Affichage du modele de formulaire
        $res .= baz_afficher_formulaire_fiche('saisie', $url);
    }

    //------------------------------------------------------------------------------------------------
    // CAS DE LA MODIFICATION D'UNE FICHE (FORMULAIRE DE MODIFICATION)
    //------------------------------------------------------------------------------------------------
    if ($mode == BAZ_ACTION_MODIFIER) {
        $res .= baz_afficher_formulaire_fiche('modification', $url, $valeurs);
    }

    //------------------------------------------------------------------------------------------------
    // CAS DE L'AJOUT D'UNE FICHE
    //------------------------------------------------------------------------------------------------
    if ($mode == BAZ_ACTION_NOUVEAU_V) {
        $valid = validateForm($_POST);
        if ($valid['result']) {
            $valeur = baz_insertion_fiche($_POST);
            if (!empty($GLOBALS['params']['redirecturl'])) {
                header('Location: '.$GLOBALS['params']['redirecturl']);
            } else {
                // Redirection pour eviter la revalidation du formulaire
                $urlParams = 'message=ajout_ok&'.BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_CONSULTER
              .'&'.BAZ_VARIABLE_ACTION.'='.BAZ_VOIR_FICHE.'&id_fiche='.$valeur['id_fiche'];
                header('Location: '.$GLOBALS['wiki']->href($iframe, $GLOBALS['wiki']->getPageTag(), $urlParams, false));
            }
            exit;
        } else {
            echo '<div class="alert alert-danger">'.$valid['error'].'</div>';
        }
    }

    //------------------------------------------------------------------------------------------------
    // CAS DE LA MODIFICATION D'UNE FICHE (VALIDATION ET MAJ)
    //------------------------------------------------------------------------------------------------
    if ($mode == BAZ_ACTION_MODIFIER_V) {
        $valid = validateForm($_POST);
        if ($valid['result'] && baz_a_le_droit('saisie_fiche', $GLOBALS['wiki']
                ->GetPageOwner($_POST['id_fiche']))) {
            $valeur = baz_mise_a_jour_fiche($_POST);

            if ($GLOBALS['wiki']->GetPageTag() != $valeur['id_fiche']) {
                // Redirection pour eviter la revalidation du formulaire
                $urlParams = 'message=modif_ok&'.BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_CONSULTER
                  .'&'.BAZ_VARIABLE_ACTION.'='.BAZ_VOIR_FICHE.'&id_fiche='.$valeur['id_fiche'];
                header('Location: '.$GLOBALS['wiki']->href($iframe, $GLOBALS['wiki']->getPageTag(), $urlParams, true));
            } else {
                header('Location: '.$GLOBALS['wiki']->href($iframe, $GLOBALS['wiki']->GetPageTag()));
            }
            exit;
        } else {
            echo '<div class="alert alert-danger">'.$valid['error'].'</div>';
        }
    }

    return $res;
}

/** baz_afficher_formulaire_fiche() - Genere le formulaire de saisie d'une annonce
 * @param   string type de formulaire: insertion ou modification
 * @param   string  url de renvois du formulaire (facultatif)
 * @param   array   valeurs de la fiche en cas de modification (facultatif)
 *
 * @return string code HTML avec formulaire
 */
function baz_afficher_formulaire_fiche($mode, $url = '', $valeurs = '')
{
    $res = '';
    if (isset($valeurs['id_typeannonce'])) {
        $form = baz_valeurs_formulaire($valeurs['id_typeannonce']);
    } elseif (isset($_GET['id_typeannonce'])) {
        $form = baz_valeurs_formulaire($_GET['id_typeannonce']);
    } elseif (isset($_GET['id'])) {
        $form = baz_valeurs_formulaire($_GET['id']);
    } elseif (isset($_POST['id_typeannonce'])) {
        $form = baz_valeurs_formulaire($_POST['id_typeannonce']);
    } else {
        $form = baz_valeurs_formulaire($GLOBALS['params']['idtypeannonce']);
    }

    //titre de la rubrique
    $res .=
    '<h3 class="titre_type_fiche">'._t('BAZ_TITRE_SAISIE_FICHE').'&nbsp;'.$form['bn_label_nature'].'</h3>'."\n";

    //si le type de formulaire requiert une acceptation des conditions on affiche les conditions
    if ($form['bn_condition'] != '' && !isset($_POST['accept_condition']) &&
        !isset($_POST['bf_titre'])) {
        $urlParams = BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_SAISIR;
        if (!empty($valeurs['id_fiche'])) {
            $urlParams .= '&id_fiche='.$valeurs['id_fiche'];
        }
        $data['conditions'] = true;
        $data['url'] = ($url ? $url : $GLOBALS['wiki']->href('', $GLOBALS['wiki']->getPageTag(), $urlParams));
        $data['content'] = $form['bn_condition'].'<div class="checkbox">
  <label>
    <input type="checkbox" required name="accept_condition" value="1">
    '._t('BAZ_ACCEPTE_CONDITIONS').'
  </label>
</div>';
        $data['idtypeannonce'] = $form['bn_id_nature'];
    } else {
        // affichage du formulaire si conditions acceptees
        if (!empty($valeurs['id_fiche'])) {
            $urlParams = 'id_fiche='.$valeurs['id_fiche'].'&'.BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_SAISIR;
        } else {
            $urlParams = BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_SAISIR;
        }
        $data['url'] = ($url ? $url :
                    $GLOBALS['wiki']->href('', $GLOBALS['wiki']->getPageTag(), $urlParams));

        // parcours du fichier de templates, pour mettre les valeurs des champs
        $tableau = formulaire_valeurs_template_champs($form['bn_template']);
        if (!is_array($valeurs) && !empty($valeurs) && $GLOBALS['wiki']->isWikiName($valeurs)) {
            // ajout des valeurs par defaut pour une modification
            $valeurs = baz_valeurs_fiche($valeurs);
        }
        $data['content'] = '';
        $formtemplate = '';
        for ($i = 0; $i < count($tableau); ++$i) {
            $data['content'] .= $tableau[$i][0]($formtemplate, $tableau[$i], 'saisie', $valeurs);
        }
        $data['idtypeannonce'] = $form['bn_id_nature'];

        //si on a passe une url, on est dans le cas d'une page de type fiche_bazar, il nous faut le nom
        if ($url != '') {
            $data['idfiche'] = $valeurs['id_fiche'];
        }

        // Ajout du mot de passe général pour Bazar
        if (isset($GLOBALS['wiki']->config['password_for_editing'])
            and !empty($GLOBALS['wiki']->config['password_for_editing'])
            and isset($_POST['password_for_editing']) ) {
            $data['passwordforediting'] = $_POST['password_for_editing'];
        }
    }

    $GLOBALS['wiki']->AddJavascriptFile('tools/bazar/libs/bazar.js');

    //Affichage a l'ecran
    include_once 'includes/squelettephp.class.php';
    try {
        $squel = new SquelettePhp('form_edit_entry.tpl.html', 'bazar');
        $res .=  $squel->render($data);
    } catch (Exception $e) {
        $res .= '<div class="alert alert-danger">Erreur form edit fiche : '.$e->getMessage().'</div>'."\n";
    }
    return $res;
}

/** baz_requete_bazar_fiche() - prepare la requete d'insertion ou de MAJ de la fiche en supprimant
 * de la valeur POST les valeurs inadequates et en formattant les champs.
 *
 * @global   mixed L'objet contenant les valeurs issues de la saisie du formulaire
 *
 * @return array Tableau des valeurs de la fiche a sauver
 */
function baz_requete_bazar_fiche($valpost)
{
    $valeur = array();
    // test pour les titres formatés à partir d'autres champs
    preg_match_all('#{{(.*)}}#U', $valpost['bf_titre'], $matches);
    if (count($matches[0]) > 0) {
        $valpost = array_merge($valpost, titre($formtemplate, array('titre',
            $valpost['bf_titre'], ), 'requete', $valpost));
    }
    // si l'on a pas la valeur de l'identifiant de la fiche, on la genere
    if (!isset($valpost['id_fiche'])) {
        // l'identifiant (sous forme de NomWiki) est genere a partir du titre
        $valpost['id_fiche'] = genere_nom_wiki($valpost['bf_titre']);
        $_POST['id_fiche'] = $valpost['id_fiche'];
    }

    //createur de la fiche
    if ($GLOBALS['wiki']->GetPageOwner($valpost['id_fiche'])) {
        $valpost['createur'] = $GLOBALS['wiki']->GetPageOwner($valpost['id_fiche']);
    } elseif ($user = $GLOBALS['wiki']->GetUser()) {
        $valpost['createur'] = $user['name'];
    } else {
        $valpost['createur'] = _t('BAZ_ANONYME');
    }

    $valpost['id_typeannonce'] = isset($valpost['id_typeannonce']) ? $valpost['id_typeannonce'] : $_REQUEST['id_typeannonce'];
    $form = baz_valeurs_formulaire($valpost['id_typeannonce']);

    // on récupérer la date de création si elle existe déjà, on l'initialise sinon
    $datecreation = $GLOBALS['wiki']->LoadSingle(
        'SELECT MIN(time) as firsttime FROM '.$GLOBALS['wiki']->config['table_prefix'].
        "pages WHERE tag='".$valpost['id_fiche']."'"
    );
    $valpost['date_creation_fiche'] = $datecreation['firsttime'] ?
    $datecreation['firsttime'] : date('Y-m-d H:i:s', time());

    // statut fiche
    if ($GLOBALS['wiki']->UserIsAdmin()) {
        $valpost['statut_fiche'] = '1';
    } else {
        $valpost['statut_fiche'] = $GLOBALS['wiki']->config['BAZ_ETAT_VALIDATION'];
    }

    // Champ sendmail positionne : on envoi un mail ...
    if (isset($valpost['sendmail'])) {
        if ($valpost[$valpost['sendmail']] != '') {
            $destmail = $valpost[$valpost['sendmail']];
        }
        unset($valpost['sendmail']);
    }

    //pour les checkbox, on met les resultats sur une ligne
    foreach ($valpost as $cle => $val) {
        if (is_array($val)) {
            $valpost[$cle] = implode(',', array_keys($val));
        }
    }

    if ($GLOBALS['wiki']->UserIsAdmin()) {
        $valpost['statut_fiche'] = '1';
    } else {
        $valpost['statut_fiche'] = $GLOBALS['wiki']->config['BAZ_ETAT_VALIDATION'];
    }

    $tableau = formulaire_valeurs_template_champs($form['bn_template']);
    for ($i = 0; $i < count($tableau); ++$i) {
        // appel des fonctions
        $tab = $tableau[$i][0]($formtemplate, $tableau[$i], 'requete',
            $valpost);

        if (is_array($tab)) {
            if (isset($tab['fields-to-remove']) and is_array($tab['fields-to-remove'])) {
                foreach ($tab['fields-to-remove'] as $field) {
                    if (isset($valpost[$field])) {
                        unset($valpost[$field]);
                    }
                }
                unset($tab['fields-to-remove']);
            }
            $valpost = array_merge($valpost, $tab);
        }
    }
    $valpost['date_maj_fiche'] = date('Y-m-d H:i:s', time());

    // si un mail d envoie de la fiche est present, on envoie!
    if (isset($destmail)) {
        include_once 'includes/email.inc.php';
        $lien = str_replace('/wakka.php?wiki=', '', $GLOBALS['wiki']
                ->config['base_url']);
        $sujet = removeAccents('['.str_replace(array('http://', 'https://'), '', $lien).'] Votre fiche : '.$valpost['bf_titre']);
        $lienfiche = $GLOBALS['wiki']->config['base_url'].$valpost['id_fiche'];
        $texthtml = 'Bienvenue sur '.removeAccents(str_replace('http://', '', $lien).' , ');
        $text = 'Bienvenue sur '.removeAccents(str_replace('http://', '', $lien).' , ');
        $text .= 'allez sur le site pour gérer votre inscription  : '.$lienfiche;
        $texthtml .= '<br /><br /><a href="'.$lienfiche.'" title="Voir la fiche">Voir la fiche sur le site</a>';
        if (isset($GLOBALS['wiki']->config['mail_custom_message'])) {
            $texthtml .= nl2br($GLOBALS['wiki']->config['mail_custom_message']);
        }
        $fichier = 'tools/bazar/presentation/styles/bazar.css';
        $style = file_get_contents($fichier);
        $style = str_replace('url(', 'url('.$lien.'/tools/bazar/presentation/', $style);
        $fiche = $texthtml.str_replace('src="tools', 'src="'.$lien.'/tools', baz_voir_fiche(0, $valpost));
        $html = '<html><head><style type="text/css">'.$style.'</style></head><body>'.$fiche.'</body></html>';

        send_mail($GLOBALS['wiki']->config['BAZ_ADRESSE_MAIL_ADMIN'], $GLOBALS['wiki']->config['BAZ_ADRESSE_MAIL_ADMIN'], $destmail, $sujet, $text, $html);
    }

    // on enleve les champs hidden pas necessaires a la fiche
    unset($valpost['valider']);
    unset($valpost['MAX_FILE_SIZE']);
    unset($valpost['antispam']);
    unset($valpost['mot_de_passe_wikini']);
    unset($valpost['mot_de_passe_repete_wikini']);

    // on encode en utf-8 pour reussir a encoder en json
    if (YW_CHARSET != 'UTF-8') {
        $valpost = array_map('utf8_encode', $valpost);
    }

    return $valpost;
}

/**  validateForm() - inserer une nouvelle fiche
 * @array   Le tableau des valeurs a inserer
 */
function validateForm($valeur)
{
    if (!isset($valeur['antispam']) or !$valeur['antispam'] == 1) {
        return array(
            'result' => false,
            'error' => _t('BAZ_PROTECTION_ANTISPAM')
        );
    }
    // On teste le titre car ça peut bugguer sérieusement sans
    if (!isset($valeur['bf_titre'])) {
        return array(
            'result' => false,
            'error' => _t('BAZ_FICHE_NON_SAUVEE_PAS_DE_TITRE')
        );
    }

    // form metadata
    if (!isset($valeur['id_typeannonce'])) {
        return array(
            'result' => false,
            'error' => _t('BAZ_NO_FORMS_FOUND')
        );
    }

    // form validates!
    return array('result' => true);
}

/** baz_insertion_fiche() - inserer une nouvelle fiche
 * @array   Le tableau des valeurs a inserer
 * @boolen  True : insertion en lot
 */
function baz_insertion_fiche($valeur)
{
    $valeur = baz_requete_bazar_fiche($valeur);

    // on change provisoirement d'utilisateur
    if (isset($GLOBALS['utilisateur_wikini'])) {
        $olduser = $GLOBALS['wiki']->GetUser();
        $GLOBALS['wiki']->LogoutUser();

        // On s'identifie de facon a attribuer la propriete de la fiche a
        // l'utilisateur qui vient d etre cree
        $user = $GLOBALS['wiki']->LoadUser($GLOBALS['utilisateur_wikini']);
        $GLOBALS['wiki']->SetUser($user);
    }

    $ignoreAcls = true;
    if (isset($GLOBALS['wiki']->config['bazarIgnoreAcls'])) {
        $ignoreAcls = $GLOBALS['wiki']->config['bazarIgnoreAcls'];
    }

    // on sauve les valeurs d'une fiche dans une PageWiki, retourne 0 si succès
    $saved = $GLOBALS['wiki']->SavePage(
        $valeur['id_fiche'],
        json_encode($valeur),
        '',
        $ignoreAcls // Ignore les ACLs
    );

    // on cree un triple pour specifier que la page wiki creee est une fiche
    // bazar
    if ($saved == 0) {
        $GLOBALS['wiki']->InsertTriple(
            $valeur['id_fiche'],
            'http://outils-reseaux.org/_vocabulary/type',
            'fiche_bazar',
            '',
            ''
        );
    }

    // on remet l'utilisateur initial
    if (isset($GLOBALS['utilisateur_wikini'])) {
        $GLOBALS['wiki']->LogoutUser();
        if (!empty($olduser)) {
            $GLOBALS['wiki']->SetUser($olduser, 1);
        }
    }

    // Envoi d un mail aux administrateurs
    if ($GLOBALS['wiki']->config['BAZ_ENVOI_MAIL_ADMIN']) {
        include_once 'tools/contact/libs/contact.functions.php';

        $lien = str_replace('/wakka.php?wiki=', '', $GLOBALS['wiki']
                ->config['base_url']);
        $sujet = removeAccents('['.str_replace('http://', '', $lien)
            .'] nouvelle fiche ajoutee : '.$valeur['bf_titre']);
        $text =
        'Voir la fiche sur le site pour l\'administrer : '.$GLOBALS['wiki']->href('', $valeur['id_fiche']);
        $texthtml = '<br /><br /><a href="'.$GLOBALS['wiki']->href('', $valeur['id_fiche']).'" title="Voir la fiche">Voir la fiche sur le site pour l\'administrer</a>';
        $fichier = 'tools/bazar/presentation/styles/bazar.css';
        $style = file_get_contents($fichier);
        $style = str_replace('url(', 'url('.$lien.'/tools/bazar/presentation/', $style);
        $fiche = str_replace(
            'src="tools',
            'src="'.$lien.'/tools',
            baz_voir_fiche(0, $valeur['id_fiche'])
        ).$texthtml;
        $html =
        '<html><head><style type="text/css">'.$style.
        '</style></head><body>'.$fiche.'</body></html>';

        //on va chercher les admins
        $requeteadmins = 'SELECT value FROM '.$GLOBALS['wiki']
            ->config['table_prefix'].'triples '
        .'WHERE resource="ThisWikiGroup:admins" AND property="http://www.wikini.net/_vocabulary/acls" LIMIT 1';
        $ligne = $GLOBALS['wiki']->LoadSingle($requeteadmins);
        $tabadmin = explode("\n", $ligne['value']);
        foreach ($tabadmin as $line) {
            $admin = $GLOBALS['wiki']->LoadUser(trim($line));
            send_mail($GLOBALS['wiki']->config['BAZ_ADRESSE_MAIL_ADMIN'], $GLOBALS['wiki']->config['BAZ_ADRESSE_MAIL_ADMIN'], $admin['email'], $sujet, $text, $html);
        }
    }

    return $valeur;
}

/** baz_mise_a_jour() - Mettre a jour une fiche
 * @global   Le contenu du formulaire de saisie de l'annonce
 */
function baz_mise_a_jour_fiche($valeur)
{
    $valeur = baz_requete_bazar_fiche($valeur);
    // on sauve les valeurs d'une fiche dans une PageWiki, pour garder l'historique
    $GLOBALS['wiki']->SavePage($valeur['id_fiche'], json_encode($valeur));

    // Envoie d un mail aux administrateurs
    if ($GLOBALS['wiki']->config['BAZ_ENVOI_MAIL_ADMIN']) {
        include_once 'tools/contact/libs/contact.functions.php';
        $lien = str_replace('/wakka.php?wiki=', '', $GLOBALS['wiki']
                ->config['base_url']);
        $sujet = removeAccents('['.str_replace('http://', '', $lien).'] fiche modifiee : '.$_POST['bf_titre']);
        $text =
        'Voir la fiche sur le site pour l\'administrer : '.$GLOBALS['wiki']->href('', $valeur['_BAZAR_']['id_fiche']);
        $texthtml = '<br /><br /><a href="'.$GLOBALS['wiki']->href('', $valeur['_BAZAR_']['id_fiche']).
        '" title="Voir la fiche">Voir la fiche sur le site pour l\'administrer</a>';
        $fichier = 'tools/bazar/presentation/styles/bazar.css';
        $style = file_get_contents($fichier);
        $style = str_replace('url(', 'url('.$lien.'/tools/bazar/presentation/', $style);
        $fiche = str_replace('src="tools', 'src="'.$lien.'/tools', baz_voir_fiche(0, $valeur['id_fiche'])).$texthtml;
        $html =
        '<html><head><style type="text/css">'.$style.
        '</style></head><body>'.$fiche.'</body></html>';

        //on va chercher les admins
        $requeteadmins = 'SELECT value FROM '.$GLOBALS['wiki']
            ->config['table_prefix'].'triples '

        .

        'WHERE resource="ThisWikiGroup:admins" AND property="http://www.wikini.net/_vocabulary/acls" LIMIT 1';
        $ligne = $GLOBALS['wiki']->LoadSingle($requeteadmins);
        $tabadmin = explode("\n", $ligne['value']);
        foreach ($tabadmin as $line) {
            $admin = $GLOBALS['wiki']->LoadUser(trim($line));
            send_mail($GLOBALS['wiki']->config['BAZ_ADRESSE_MAIL_ADMIN'], $GLOBALS['wiki']->config['BAZ_ADRESSE_MAIL_ADMIN'], $admin['email'], $sujet, $text, $html);
        }
    }

    return $valeur;
}

/** baz_suppression() - Supprime une fiche
 * @global   L'identifiant de la fiche a supprimer
 */
function baz_suppression($idfiche)
{
    if ($idfiche != '') {
        $valeur = baz_valeurs_fiche($idfiche);
        if (baz_a_le_droit('saisie_fiche', $valeur['bf_ce_utilisateur'])) {
            //on supprime l'utilisateur associe
            if (isset($valeur['nomwiki'])) {
                $requete =
                'DELETE FROM `'.$GLOBALS['wiki']->config['table_prefix'].'users` WHERE `name` = "'.
                $valeur['nomwiki'].'"';
                $GLOBALS['wiki']->query($requete);
            }

            //on supprime les pages wiki crees
            $GLOBALS['wiki']->DeleteOrphanedPage($idfiche);
            $GLOBALS['wiki']->DeleteTriple($idfiche, 'http://outils-reseaux.org/_vocabulary/type', null, '', '');

            //on nettoie l'url, on retourne a la consultation des fiches
            $urlParams = 'message=delete_ok&'.BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_CONSULTER;
            header('Location: '.$GLOBALS['wiki']->href('', $GLOBALS['wiki']->getPageTag(), $urlParams));
            exit;
        } else {
            echo
            '<div class="alert alert-error alert-danger">'._t('BAZ_PAS_DROIT_SUPPRIMER').'</div>'."\n";
        }
    }

    return;
}

/** publier_fiche () - Publie ou non dans les fichiers XML la fiche bazar d'un utilisateur
 * @global boolean Valide: oui ou non
 */
function publier_fiche($valid)
{

    //l'utilisateur a t'il le droit de valider
    if (baz_a_le_droit('valider_fiche')) {
        if ($valid == 0) {
            $requete =
            'UPDATE '.$GLOBALS['wiki']->config['table_prefix'].
            'fiche SET  bf_statut_fiche=2 WHERE bf_id_fiche="'.
            $_GET['id_fiche'].'"';
            echo '<div class="alert alert-success">'."\n"
            .'<a data-dismiss="alert" class="close" type="button">&times;</a>'
            ._t('BAZ_FICHE_PAS_VALIDEE').'</div>'."\n";
        } else {
            $requete =
            'UPDATE '.$GLOBALS['wiki']->config['table_prefix'].
            'fiche SET  bf_statut_fiche=1 WHERE bf_id_fiche="'.
            $_GET['id_fiche'].'"';
            echo '<div class="alert alert-success">'."\n"
            .'<a data-dismiss="alert" class="close" type="button">&times;</a>'
            ._t('BAZ_FICHE_VALIDEE').'</div>'."\n";
        }

        // ====================Mise a jour de la table '.$GLOBALS['wiki']->config['table_prefix'].'fiche====================
        $resultat = $GLOBALS['wiki']->query($requete);

        unset($resultat);

        //TODO envoie mail annonceur
    }

    return;
}

/** baz_liste_rss() affiche le formulaire qui permet de s'inscrire pour recevoir des annonces d'un type
 *   @return  string    le code HTML
 */
function baz_liste_rss()
{
    $res = '';
    //$res .= '<h2>' . _t('BAZ_S_ABONNER_AUX_FICHES') . '</h2>' . "\n";

    //requete pour obtenir l'id et le label des types d'annonces
    $resultat = baz_valeurs_formulaire();

    $liste = '';
    foreach ($resultat as $ligne) {
        $liste .= '<li><a href="'.$GLOBALS['wiki']->href('rss', '', 'id='.$ligne['bn_id_nature'])
        .'"><img src="tools/bazar/presentation/images/BAZ_rss.png" alt="'
        ._t('BAZ_RSS').'" /></a>&nbsp;';
        $liste .= $ligne['bn_label_nature'];
        $liste .= '</li>'."\n";
    }
    if ($liste != '') {
        $res .=
        '<ul class="list-unstyled unstyled">'."\n".'<li><a href="'.
        $GLOBALS['wiki']->href('rss')

        .'"><img src="tools/bazar/presentation/images/BAZ_rss.png" alt="'.
        _t('BAZ_RSS').'" /></a>&nbsp;<strong>'
        ._t('BAZ_FLUX_RSS_GENERAL').'</strong></li>'."\n".$liste.
        '</ul>'."\n";
    } else {
        $res .=
        '<div class="alert alert-info">'._t('BAZ_NO_FORMS_FOUND').
        '.</div>'."\n";
    }

    return $res;
}

/** baz_formulaire_des_formulaires() retourne le formulaire de saisie des formulaires
 *   @return  object    le code HTML
 */
function baz_formulaire_des_formulaires($mode, $form = '')
{
    // contruction du squelette du formulaire
    $urlParams = BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_FORMULAIRE;
    $data['url'] = $GLOBALS['wiki']->href('', $GLOBALS['wiki']->getPageTag(), $urlParams);

    // valeurs du formulaire
    $valform = array();
    if (is_array($form)) {
        foreach ($form as $key => $value) {
            if ($key != 'template' and $key != 'prepared') {
                $valform[$key] = htmlentities($value, ENT_QUOTES, YW_CHARSET);
            }
        }
    }
    $data['form'] = count($valform) > 0 ? $valform : '';

    // champs du formulaire
    $data['idformulaire'] = isset($_GET['idformulaire']) ? $_GET['idformulaire'] : '';

    include_once 'includes/squelettephp.class.php';
    try {
        $squel = new SquelettePhp('form_edit_form.tpl.html', 'bazar');
        return $squel->render($data);
    } catch (Exception $e) {
        return '<div class="alert alert-danger">Erreur form edit form : '.$e->getMessage().'</div>'."\n";
    }
}

/*
 *
 *
 */
function bazPrepareFormData($form)
{
    $i = 0;
    $prepared = $result = [];
    $form['template'] = _convert($form['template'], 'ISO-8859-15');
    foreach ($form['template'] as $formelem) {
        if (in_array($formelem[0], array('radio', 'liste', 'checkbox', 'listefiche', 'checkboxfiche'))) {
            //identifiant dans la base
            $prepared[$i]['id'] = $formelem[0].$formelem[1].$formelem[6];

            // type de champ
            if (in_array($formelem[0], array('listefiche', 'liste'))) {
                $prepared[$i]['type'] = 'select';
            } elseif (in_array($formelem[0], array('checkboxfiche', 'checkbox'))) {
                $prepared[$i]['type'] = 'checkbox';
            } else {
                $prepared[$i]['type'] = 'radio';
            }

            // texte d'invitation à la saisie
            $prepared[$i]['label'] = $formelem[2];

            // attributs html du champs
            $prepared[$i]['attributes'] = '';

            // champs obligatoire
            if ($formelem[8]==1) {
                $prepared[$i]['required'] = true;
            } else {
                $prepared[$i]['required'] = false;
            }

            // valeurs associées
            if (in_array($formelem[0], array('radio', 'liste', 'checkbox'))) {
                $prepared[$i]['values'] = baz_valeurs_liste($formelem[1]);
                $prepared[$i]['values']['id'] = $formelem[1];
            } else {
                $tabquery = array();
                if (!empty($formelem[12])) {
                    $tableau = array();
                    $tab = explode('|', $formelem[12]);
                     //découpe la requete autour des |
                    foreach ($tab as $req) {
                        $tabdecoup = explode('=', $req, 2);
                        $tableau[$tabdecoup[0]] = trim($tabdecoup[1]);
                    }
                    $tabquery = array_merge($tabquery, $tableau);
                } else {
                    $tabquery = '';
                }
                $hash = md5($formelem[1].serialize($tabquery));
                if (!isset($result[$hash])) {
                    $result[$hash] = baz_requete_recherche_fiches(
                        $tabquery,
                        '',
                        $formelem[1],
                        '',
                        1,
                        '',
                        '',
                        false,
                        (!empty($formelem[13])) ? $formelem[13] : ''
                    );
                }
                $prepared[$i]['values']['titre_liste'] = $formelem[2];
                foreach ($result[$hash] as $res) {
                    $valeurs_fiche = json_decode($res['body'], true);
                    $prepared[$i]['values']['label'][$valeurs_fiche['id_fiche']] = $valeurs_fiche['bf_titre'];
                }
            }

            // texte d'aide
            $prepared[$i]['helper'] = $formelem[10];
        } elseif (in_array(
            $formelem[0],
            array('texte', 'textelong', 'jour', 'listedatedeb', 'listedatefin', 'mot_de_passe', 'lien_internet', 'champs_mail')
        )) {
            //identifiant dans la base
            $prepared[$i]['id'] = $formelem[1];

            // type de champ
            if (!empty($formelem[7]) && in_array(
                $formelem[7],
                array('text', 'date', 'email', 'url', 'range', 'password', 'number')
            )) {
                $prepared[$i]['type'] = $formelem[7];
            } elseif (in_array($formelem[0], array('texte'))) {
                $prepared[$i]['type'] = 'text';
            } elseif (in_array($formelem[0], array('textelong'))) {
                $prepared[$i]['type'] = 'textarea';
            } elseif (in_array($formelem[0], array('jour', 'listedatedeb', 'listedatefin'))) {
                $prepared[$i]['type'] = 'date';
            } elseif (in_array($formelem[0], array('champs_mail'))) {
                $prepared[$i]['type'] = 'email';
            } elseif (in_array($formelem[0], array('lien_internet'))) {
                $prepared[$i]['type'] = 'url';
            } elseif (in_array($formelem[0], array('mot_de_passe'))) {
                $prepared[$i]['type'] = 'password';
            }

            // texte d'invitation à la saisie
            $prepared[$i]['label'] = $formelem[2];

            // attributs html du champs
            $prepared[$i]['attributes'] = '';
            if (in_array($formelem[0], array('texte'))) {
                if (in_array($formelem[7], array('range', 'number'))) {
                    $prepared[$i]['attributes'] .= ($formelem[3] != '') ? ' min="'.$formelem[3].'"' : '';
                    $prepared[$i]['attributes'] .= ' max="'.$formelem[4].'"';
                } else {
                    $prepared[$i]['attributes'] .= ' maxlength="'.$formelem[4].'" size="'.$formelem[4].'"';
                };
            } elseif (in_array($formelem[0], array('textelong'))) {
                $prepared[$i]['attributes'] .= ' rows="' . $formelem[4] . '"';
            }
            $prepared[$i]['attributes'] .= ($formelem[6] != '') ? ' pattern="' . $formelem[6] . '"' : '';

            // champs obligatoire
            if ($formelem[8]==1) {
                $prepared[$i]['required'] = true;
            } else {
                $prepared[$i]['required'] = false;
            }

            // valeurs associées
            $prepared[$i]['values'] = '';

            // texte d'aide
            $prepared[$i]['helper'] = $formelem[10];
        } elseif (in_array(
            $formelem[0],
            array('fichier', 'image')
        )) {
            //identifiant dans la base
            $prepared[$i]['id'] = $formelem[0].$formelem[1];

            // type de champ
            $prepared[$i]['type'] = 'file';

            // texte d'invitation à la saisie
            $prepared[$i]['label'] = $formelem[2];

            // attributs html du champs
            $prepared[$i]['attributes'] = '';
            if (in_array($formelem[0], array('image'))) {
                $prepared[$i]['attributes'] .= ' accept="image/*"';
            }
            // champs obligatoire
            if ($formelem[8]==1) {
                $prepared[$i]['required'] = true;
            } else {
                $prepared[$i]['required'] = false;
            }

            // valeurs associées
            $prepared[$i]['values'] = '';

            // texte d'aide
            $prepared[$i]['helper'] = $formelem[10];
        } elseif (in_array(
            $formelem[0],
            array('champs_cache', 'titre')
        )) {
            //identifiant dans la base
            if ($formelem[0] == 'titre') {
                $prepared[$i]['id'] = 'bf_titre';
            } else {
                $prepared[$i]['id'] = $formelem[1];
            }

            // type de champ
            $prepared[$i]['type'] = 'hidden';

            // texte d'invitation à la saisie
            $prepared[$i]['label'] = '';

            // attributs html du champs
            $prepared[$i]['attributes'] = '';

            // champs obligatoire
            $prepared[$i]['required'] = '';

            // valeurs associées
            if ($formelem[0] == 'titre') {
                $prepared[$i]['values'] = $formelem[1];
            } else {
                $prepared[$i]['values'] = $formelem[2];
            }

            // texte d'aide
            $prepared[$i]['helper'] = '';
        } elseif (in_array(
            $formelem[0],
            array('labelhtml')
        )) {
            //identifiant dans la base
            $prepared[$i]['id'] = '';

            // type de champ
            $prepared[$i]['type'] = 'html';

            // texte d'invitation à la saisie
            $prepared[$i]['label'] = $formelem[1];

            // attributs html du champs
            $prepared[$i]['attributes'] = '';

            // champs obligatoire
            $prepared[$i]['required'] = '';

            // valeurs associées
            $prepared[$i]['values'] = $formelem[3];

            // texte d'aide
            $prepared[$i]['helper'] = '';
        } elseif (in_array(
            $formelem[0],
            array('carte_google')
        )) {
            //identifiant dans la base
            $prepared[$i]['id'] = '';

            // type de champ
            $prepared[$i]['type'] = 'map';

            // texte d'invitation à la saisie
            $prepared[$i]['label'] = '';

            // attributs html du champs
            $prepared[$i]['attributes'] = '';

            // champs obligatoire
            if ($formelem[8]==1) {
                $prepared[$i]['required'] = true;
            } else {
                $prepared[$i]['required'] = false;
            }

            // valeurs associées
            $prepared[$i]['values'] = '';

            // texte d'aide
            $prepared[$i]['helper'] = '';
        } elseif (in_array(
            $formelem[0],
            array('inscriptionliste')
        )) {
            //identifiant dans la base
            $prepared[$i]['id'] = str_replace(array('@', '.'), array('', ''), $formelem[1]);

            // type de champ
            $prepared[$i]['type'] = 'listsubscribe';

            // texte d'invitation à la saisie
            $prepared[$i]['label'] = $formelem[2];

            // attributs html du champs
            $prepared[$i]['attributes'] = '';

            // champs obligatoire
            $prepared[$i]['required'] = '';

            // valeurs associées
            $prepared[$i]['values'] = $formelem[1];

            // texte d'aide
            $prepared[$i]['helper'] = '';
        } elseif (in_array(
            $formelem[0],
            array('utilisateur_wikini')
        )) {
            //identifiant dans la base
            $prepared[$i]['id'] = $formelem[1];

            // type de champ
            $prepared[$i]['type'] = 'wikiuser';

            // texte d'invitation à la saisie
            $prepared[$i]['label'] = '';

            // attributs html du champs
            $prepared[$i]['attributes'] = '';

            // champs obligatoire
            $prepared[$i]['required'] = '';

            // valeurs associées
            $prepared[$i]['values'] = '';

            // texte d'aide
            $prepared[$i]['helper'] = $formelem[1];
        }

        $i++;
    }
    return $prepared;
}


/** baz_valeurs_formulaire() - Toutes les informations du formulaire demande
 * @param    string Identifiant de la PageWiki du formulaire
 *
 * @return array
 */
function baz_valeurs_formulaire($idformulaire = [])
{
    if (is_array($idformulaire) and count($idformulaire) > 0) {
        $tabf = array();
        foreach ($idformulaire as $id) {
            if (!isset($GLOBALS['_BAZAR_']['form'][$id])) {
                $GLOBALS['_BAZAR_']['form'][$id] = baz_valeurs_formulaire($id);
            }
            $tabf[$id] = $GLOBALS['_BAZAR_']['form'][$id];
        }
        if (count($idformulaire) == 1) {
            $k = array_values($idformulaire);
            $id = array_shift($k);
            $tabf[$id] = $GLOBALS['_BAZAR_']['form'][$id];
        }
        return $tabf;
    } elseif ($idformulaire != '' and !is_array($idformulaire)) {
        if (!isset($GLOBALS['_BAZAR_']['form'][$idformulaire])) {
            $requete = 'SELECT * FROM '.$GLOBALS['wiki']->config['table_prefix'].'nature WHERE bn_id_nature='.$idformulaire;
            $tab_resultat = $GLOBALS['wiki']->LoadSingle($requete);
            if ($tab_resultat) {
                foreach ($tab_resultat as $key => $value) {
                    $GLOBALS['_BAZAR_']['form'][$idformulaire][$key] =
                    _convert($value, 'ISO-8859-15');
                }
            } else {
                return false;
            }
        }
        $GLOBALS['_BAZAR_']['form'][$idformulaire]['template'] =
          formulaire_valeurs_template_champs(
              $GLOBALS['_BAZAR_']['form'][$idformulaire]['bn_template']
          );
        if (!isset($GLOBALS['_BAZAR_']['form'][$idformulaire]['prepared'])) {
            $GLOBALS['_BAZAR_']['form'][$idformulaire]['prepared'] =
              bazPrepareFormData($GLOBALS['_BAZAR_']['form'][$idformulaire]);
        }

        return $GLOBALS['_BAZAR_']['form'][$idformulaire];
    } else {
        $requete = 'SELECT * FROM '.$GLOBALS['wiki']->config['table_prefix'].'nature';
        $requete .= ' ORDER BY bn_label_nature ASC';
        $tab_resultat = $GLOBALS['wiki']->LoadAll($requete);
        foreach ($tab_resultat as $key => $value) {
            $GLOBALS['_BAZAR_']['form'][$value['bn_id_nature']] =
            baz_valeurs_formulaire($value['bn_id_nature']);
            $GLOBALS['_BAZAR_']['form'][$value['bn_id_nature']]['template'] =
              formulaire_valeurs_template_champs(
                  $value['bn_template']
              );
            if (!isset($GLOBALS['_BAZAR_']['form'][$value['bn_id_nature']]['prepared'])) {
                $GLOBALS['_BAZAR_']['form'][$value['bn_id_nature']]['prepared'] =
                  bazPrepareFormData($GLOBALS['_BAZAR_']['form'][$value['bn_id_nature']]);
            }
        }
    }
    return isset($GLOBALS['_BAZAR_']['form']) ? $GLOBALS['_BAZAR_']['form'] : null;
}

/** baz_formulaire_des_listes() retourne le formulaire de saisie des listes
 *   @return  object    le code HTML
 */
function baz_formulaire_des_listes($mode, $valeursliste = '')
{
    // champs du formulaire
    if (isset($_GET['idliste'])) {
        $tab_formulaire['NomWiki'] = $_GET['idliste'];
    } else {
        $tab_formulaire['NomWiki'] = '';
    }
    $tab_formulaire['valeursliste'] = $valeursliste;
    if (isset($valeursliste['titre_liste'])) {
        $tab_formulaire['titre_liste'] = $valeursliste['titre_liste'];
    }

    // test si on est dans une iframe
    $iframe = testUrlInIframe();

    $tab_formulaire['form_link'] = $GLOBALS['wiki']->href(
        $iframe,
        $GLOBALS['wiki']->GetPageTag(),
        BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_LISTES.'&action='.$mode
        .(isset($_GET['idliste']) ? '&idliste='.$_GET['idliste'] : '')
    );
    $tab_formulaire['cancel_link'] = $GLOBALS['wiki']->href(
        $iframe,
        $GLOBALS['wiki']->GetPageTag(),
        BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_LISTES
    );

    // on rajoute les bibliothèques js nécéssaires
    $GLOBALS['wiki']->addJavascriptFile('tools/bazar/libs/vendor/jquery-ui-sortable/jquery-ui.min.js');
    $GLOBALS['wiki']->addJavascriptFile('tools/bazar/libs/bazar.edit_lists.js');

    // affichage du template du formulaire
    include_once 'includes/squelettephp.class.php';
    try {
        $squel = new SquelettePhp('lists_edit.tpl.html', 'bazar');
        return $squel->render($tab_formulaire);
    } catch (Exception $e) {
        return '<div class="alert alert-danger">Erreur form edit listes : '.$e->getMessage().'</div>'."\n";
    }
}

function multiArraySearch($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, multiArraySearch($subarray, $key, $value));
        }
    }

    return $results;
}

/** Affiche le listing des formulaires et permet de les modifier
 *  
 * @return string le code HTML
 */
function baz_gestion_formulaire()
{
    $res = '';
    if (!$GLOBALS['wiki']->GetUser()) {
        $res .= '<div class="alert alert-warning">'._t('BAZ_AUTH_NEEDED').'.</div>';
    } elseif (isset($_GET['action_formulaire']) && $_GET['action_formulaire'] == 'modif') {
        // il y a un formulaire a modifier

        // recuperation des informations du type de formulaire
        $form = baz_valeurs_formulaire($_GET['idformulaire']);
        $res .= baz_formulaire_des_formulaires('modif_v', $form);
    } elseif (isset($_GET['action_formulaire']) &&
        $_GET['action_formulaire'] == 'new') {
        // il y a un nouveau formulaire a saisir
        $res .= baz_formulaire_des_formulaires('new_v');
    } elseif (isset($_GET['action_formulaire']) && $_GET['action_formulaire'] == 'new_v') {
            // il y a des donnees pour ajouter un nouveau formulaire
            $requete = 'INSERT INTO '.$GLOBALS['wiki']->config['table_prefix']
            .'nature (`bn_id_nature` ,`bn_ce_i18n` ,`bn_label_nature` ,`bn_template` ,`bn_description` ,`bn_condition`)'.' VALUES ('.baz_nextId($GLOBALS['wiki']->config['table_prefix'].'nature', 'bn_id_nature', $GLOBALS['wiki']).', "fr-FR", "'
            .addslashes(_convert($_POST['bn_label_nature'], YW_CHARSET, true)).'","'
            .addslashes(_convert($_POST['bn_template'], YW_CHARSET, true)).'", "'
            .addslashes(_convert($_POST['bn_description'], YW_CHARSET, true)).'", "'
            .addslashes(_convert($_POST['bn_condition'], YW_CHARSET, true)).'")';
            $GLOBALS['wiki']->query($requete);
            $GLOBALS['wiki']->redirect($GLOBALS['wiki']->href('','', 'vue=formulaire&msg=form_created', false));     
    } elseif (isset($_GET['action_formulaire']) &&
        $_GET['action_formulaire'] == 'modif_v' &&
        baz_a_le_droit('saisie_formulaire')) {
        //il y a des donnees pour modifier un formulaire
        $requete =
        'UPDATE '.$GLOBALS['wiki']->config['table_prefix'].'nature SET '
        .'`bn_label_nature`="'.addslashes(_convert($_POST['bn_label_nature'], YW_CHARSET, true)).'" ,'
        .'`bn_template`="'.addslashes(_convert($_POST['bn_template'], YW_CHARSET, true)).'" ,'
        .'`bn_description`="'.addslashes(_convert($_POST['bn_description'], YW_CHARSET, true)).'" ,'
        .'`bn_condition`="'.addslashes(_convert($_POST['bn_condition'], YW_CHARSET, true)).'"'
        .' WHERE `bn_id_nature`='.$_POST['bn_id_nature'];
        $resultat = $GLOBALS['wiki']->query($requete);

        $res .=
        '<div class="alert alert-success">'."\n".
        '<a data-dismiss="alert" class="close" type="button">&times;</a>'.
        _t('BAZ_FORMULAIRE_MODIFIE').'</div>'."\n";
    } elseif (isset($_GET['action_formulaire']) && $_GET['action_formulaire'] == 'delete' && baz_a_le_droit('saisie_formulaire')) {
        // il y a un id de formulaire a supprimer, suppression de l'entree dans la table nature
        $requete =
        'DELETE FROM '.$GLOBALS['wiki']->config['table_prefix'].'nature WHERE bn_id_nature='.
        $_GET['idformulaire'];
        $resultat = $GLOBALS['wiki']->query($requete);

        //TODO : suppression des fiches associees au formulaire

        $res .=
        '<div class="alert alert-success">'."\n".
        '<a data-dismiss="alert" class="close" type="button">&times;</a>'.
        _t('BAZ_FORMULAIRE_ET_FICHES_SUPPRIMES').'</div>'."\n";
    }

    // affichage de la liste des templates a modifier ou supprimer
    if (!isset($_GET['action_formulaire']) ||
        ($_GET['action_formulaire'] != 'modif' &&
            $_GET['action_formulaire'] != 'new')) {
        $res = '';
        if (isset($_GET['msg']) && $_GET['msg']=='form_created') {
            $res .=
        '<div class="alert alert-success">'."\n".
        '<a data-dismiss="alert" class="close" type="button">&times;</a>'.
        _t('BAZ_NOUVEAU_FORMULAIRE_ENREGISTRE').'</div>'."\n";
        }
        $tab_forms['forms'] = array();
        $forms = baz_valeurs_formulaire('');

        // il y a des formulaires à importer
        if (isset($_POST['imported-form'])) {
            foreach ($_POST['imported-form'] as $id => $value) {
                $value = json_decode($value, true);
                $searchformname = multiArraySearch($forms, 'bn_label_nature', $value['bn_label_nature']);
                // si un formulaire du même nom existe, on le remplace
                if (count($searchformname) > 0) {
                    $localform = array_pop($searchformname);
                    $value['bn_id_nature'] = $localform['bn_id_nature'];
                    $requete =
                    'UPDATE '.$GLOBALS['wiki']->config['table_prefix'].
                    'nature SET '
                    .'`bn_label_nature`="'.addslashes(_convert($value['bn_label_nature'], YW_CHARSET, true)).'" ,'
                    .'`bn_template`="'.addslashes(_convert($value['bn_template'], YW_CHARSET, true)).'" ,'
                    .'`bn_description`="'.addslashes(_convert($value['bn_description'], YW_CHARSET, true)).'" ,'
                    .'`bn_condition`="'.addslashes(_convert($value['bn_condition'], YW_CHARSET, true)).'"'
                    .' WHERE `bn_id_nature`='.$value['bn_id_nature'];

                    $forms[$value['bn_id_nature']] = $value;
                } else {
                    // si un formulaire existant porte le meme id on enregistre un nouvel id
                    $searchformid = multiArraySearch($forms, 'bn_id_nature', $id);
                    if (count($searchformid) > 0) {
                        $id = baz_nextId($GLOBALS['wiki']->config['table_prefix'].'nature', 'bn_id_nature', $GLOBALS['wiki']);
                    }
                    $requete =
                    'INSERT INTO '.$GLOBALS['wiki']->config['table_prefix'].
                    'nature (`bn_id_nature` ,`bn_ce_i18n` ,`bn_label_nature` ,`bn_template` ,`bn_description` ,`bn_condition`)'.' VALUES ('.$id.', "fr-FR", "'
                    .addslashes(_convert($value['bn_label_nature'], YW_CHARSET, true)).'", "'
                    .addslashes(_convert($value['bn_template'], YW_CHARSET, true)).'", "'
                    .addslashes(_convert($value['bn_description'], YW_CHARSET, true)).'", "'
                    .addslashes(_convert($value['bn_condition'], YW_CHARSET, true)).'")';
                    // on ajoute le formulaire à la liste des formulaires existants
                    $forms[$id] = $value;
                }
                $GLOBALS['wiki']->query($requete);
            }
            ksort($forms);
            $res .=
            '<div class="alert alert-success">'.
            _t('BAZ_FORM_IMPORT_SUCCESSFULL').'.</div>'."\n";
        }
        if (is_array($forms)) {
            foreach ($forms as $key => $ligne) {
                $tab_forms['forms'][$ligne['bn_id_nature']]['title'] = $ligne['bn_label_nature'];
                $tab_forms['forms'][$ligne['bn_id_nature']]['description'] = $ligne['bn_description'];
                $tab_forms['forms'][$ligne['bn_id_nature']]['can_edit'] = baz_a_le_droit('saisie_formulaire');
                $tab_forms['forms'][$ligne['bn_id_nature']]['can_delete'] = $GLOBALS['wiki']->UserIsAdmin();
            }
        }
        // on rajoute les bibliothèques js nécéssaires
        $GLOBALS['wiki']->addJavascriptFile('tools/bazar/libs/bazar.edit_forms.js');

        // on cherche un template personnalise dans le repertoire themes/tools/bazar/templates
        $templatetoload = 'themes/tools/bazar/templates/';
        if (!is_file($templatetoload)) {
            $templatetoload =
            'tools/bazar/presentation/templates/forms_table.tpl.html';
        }

        include_once 'includes/squelettephp.class.php';
        try {
            $squel = new SquelettePhp('forms_table.tpl.html', 'bazar');
            $res .=  $squel->render($tab_forms);
        } catch (Exception $e) {
            $res .= '<div class="alert alert-danger">Erreur tableau des formulaires  : '.$e->getMessage().'</div>'."\n";
        }
    }
    return $res;
}

/** baz_gestion_listes() affiche le listing des listes et permet de les modifier
 *   @return  string    le code HTML
 */
function baz_gestion_listes()
{
    $res = '';
    $iframe = testUrlInIframe();
    // affichage de la liste des templates a modifier ou supprimer (dans le cas ou il n'y a pas d'action selectionnee)
    if (!isset($_GET['action'])) {
        // il y a des listes à importer
        if (isset($_POST['imported-list'])) {
            foreach ($_POST['imported-list'] as $nomwikiliste => $value) {
                // on sauve les valeurs d'une liste dans une PageWiki, pour garder l'historique
                $GLOBALS['wiki']->SavePage($nomwikiliste, $value);

                // on cree un triple pour specifier que la PageWiki creee est une liste
                $GLOBALS['wiki']->InsertTriple(
                    $nomwikiliste,
                    'http://outils-reseaux.org/_vocabulary/type',
                    'liste',
                    '',
                    ''
                );
            }
            $res .=
            '<div class="alert alert-success">'.
            _t('BAZ_LIST_IMPORT_SUCCESSFULL').'.</div>'."\n";
        }

        // requete pour obtenir l'id et le label des types d'annonces
        $requete = 'SELECT resource FROM '.$GLOBALS['wiki']->config['table_prefix'].'triples '
          .'WHERE property="http://outils-reseaux.org/_vocabulary/type" AND value="liste" ORDER BY resource';
        $resultat = $GLOBALS['wiki']->LoadAll($requete);
        $tab_lists = array('lists' => array());
        foreach ($resultat as $ligne) {
            $valeursliste = baz_valeurs_liste($ligne['resource']);
            $tab_lists['lists'][$ligne['resource']]['titre_liste'] =
            $valeursliste['titre_liste'];
            $tab_lists['lists'][$ligne['resource']]['can_edit'] =
            $GLOBALS['wiki']->HasAccess(
                'write',
                $ligne['resource']
            );
            $tab_lists['lists'][$ligne['resource']]['can_delete'] =
            $GLOBALS['wiki']->UserIsAdmin() ||
            $GLOBALS['wiki']->UserIsOwner($ligne['resource']);
            $elements_liste = '';
            foreach ($valeursliste['label'] as $val) {
                preg_match_all('/<span data-lang="'.$GLOBALS['prefered_language'].'">(.*)<\/span>/Ui', $val, $matches);
                if (!empty($matches[1])) {
                    $elements_liste .= '<option>'.$matches[1][0].'</option>'."\n";
                } else {
                    $elements_liste .= '<option>'.$val.'</option>'."\n";
                }
            }
            if ($elements_liste != '') {
                $tab_lists['lists'][$ligne['resource']]['values'] =
                '<select class="form-control input-sm" id="liste_'

                .$ligne['resource'].'">'."\n".'<option>'.
                _t('BAZ_CHOISIR').'</option>'."\n"
                .$elements_liste.'</select>'."\n";
            } else {
                $tab_lists['lists'][$ligne['resource']]['values'] = '';
            }
        }
        // on rajoute les bibliothèques js nécéssaires
        $GLOBALS['wiki']->addJavascriptFile('tools/bazar/libs/bazar.edit_lists.js');
        
        include_once 'includes/squelettephp.class.php';
        try {
            $squel = new SquelettePhp('lists_table.tpl.html', 'bazar');
            $res .=  $squel->render($tab_lists);
        } catch (Exception $e) {
            $res .= '<div class="alert alert-danger">Erreur table des listes : '.$e->getMessage().'</div>'."\n";
        }
    } elseif ($_GET['action'] == BAZ_ACTION_MODIFIER_LISTE) {
        // il y a une liste a modifier, recuperation des informations
        $valeursliste = baz_valeurs_liste($_GET['idliste']);
        $res .= baz_formulaire_des_listes(BAZ_ACTION_MODIFIER_LISTE_V, $valeursliste);
    } elseif ($_GET['action'] == BAZ_ACTION_NOUVELLE_LISTE) {
        //il y a une nouvelle liste a saisir
        $res .= baz_formulaire_des_listes(BAZ_ACTION_NOUVELLE_LISTE_V);
    } elseif ($_GET['action'] == BAZ_ACTION_NOUVELLE_LISTE_V) {
        //il y a des donnees pour ajouter une nouvelle liste
        unset($_POST['valider']);
        $nomwikiliste = genere_nom_wiki('Liste '.$_POST['titre_liste']);

        //on supprime les valeurs vides et on encode en utf-8 pour reussir a encoder en json
        $i = 1;
        $valeur['label'] = array();
        foreach ($_POST['label'] as $label) {
            if (($label != null || $label != '') && ($_POST['id'][$i] != null
                || $_POST['id'][$i] != '')) {
                $valeur['label'][$_POST['id'][$i]] = $label;
                ++$i;
            }
        }
        if (YW_CHARSET != 'UTF-8') {
            $valeur['label'] = array_map('utf8_encode', $valeur['label']);
            $valeur['titre_liste'] = utf8_encode($_POST['titre_liste']);
        } else {
            $valeur['titre_liste'] = $_POST['titre_liste'];
        }

        //on sauve les valeurs d'une liste dans une PageWiki, pour garder l'historique
        $GLOBALS['wiki']->SavePage($nomwikiliste, json_encode($valeur));

        //on cree un triple pour specifier que la PageWiki creee est une liste
        $GLOBALS['wiki']->InsertTriple($nomwikiliste, 'http://outils-reseaux.org/_vocabulary/type', 'liste', '', '');

        //on redirige vers la page contenant toutes les listes, et on confirme par message la bonne saisie de la liste
        // $GLOBALS['wiki']->SetMessage(_t('BAZ_NOUVELLE_LISTE_ENREGISTREE'));
        $GLOBALS['wiki']->Redirect(
            $GLOBALS['wiki']->href($iframe, $GLOBALS['wiki']->GetPageTag(), BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_LISTES, false)
        );
    } elseif ($_GET['action'] == BAZ_ACTION_MODIFIER_LISTE_V
        && $GLOBALS['wiki']->HasAccess('write', $_POST['NomWiki'])) {
        //il y a des donnees pour modifier une liste
        unset($_POST['valider']);

        //on supprime les valeurs vides et on encode en utf-8 pour reussir a encoder en json
        $i = 1;
        $valeur['label'] = array();
        foreach ($_POST['label'] as $label) {
            if (($label != null || $label != '') && ($_POST['id'][$i] != null
                || $_POST['id'][$i] != '')) {
                $valeur['label'][$_POST['id'][$i]] = $label;
                ++$i;
            }
        }
        if (YW_CHARSET != 'UTF-8') {
            $valeur['label'] = array_map('utf8_encode', $valeur['label']);
            $valeur['titre_liste'] = utf8_encode($_POST['titre_liste']);
        } else {
            $valeur['titre_liste'] = $_POST['titre_liste'];
        }

        /* ----------------- TODO: suppressions de valeurs dans les fiches pour l'integrite des donnees
        //on verifie si les valeurs des listes ont changees afin de garder de l'integrite de la base des fiches
        foreach ($_POST["ancienlabel"] as $key => $value) {
        //si la valeur de la liste a ete changee, on repercute les changements pour les fiches contenant cette valeur
        if ( isset($_POST["label"][$key]) && $value != $_POST["label"][$key] ) {
        //TODO: fonction baz_modifier_metas_liste($_POST['NomWiki'], $value, $_POST['label'][$key]);
        }
        }

        //on supprime les valeurs des listes supprimees des fiches possedants ces valeurs
        foreach ($_POST["a_effacer_ancienlabel"] as $key => $value) {
        //TODO: fonction baz_effacer_metas_liste($_POST['NomWiki'], $value);
        }
        --------------------- */

        //on sauve les valeurs d'une liste dans une PageWiki, pour garder l'historique
        $GLOBALS['wiki']->SavePage($_POST['NomWiki'], json_encode($valeur));

        //on redirige vers la page contenant toutes les listes, et on confirme par message la modification de la liste
        // $GLOBALS['wiki']->SetMessage(_t('BAZ_LISTE_MODIFIEE'));
        $GLOBALS['wiki']->Redirect(
            $GLOBALS['wiki']->href($iframe, $GLOBALS['wiki']->GetPageTag(), BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_LISTES, false)
        );
    } elseif ($_GET['action'] == BAZ_ACTION_SUPPRIMER_LISTE &&
        isset($_GET['idliste']) && $_GET['idliste'] != '' &&
        ($GLOBALS['wiki']->UserIsAdmin() ||
            $GLOBALS['wiki']->UserIsOwner($_GET['idliste']))) {
        // il y a un id de liste a supprimer
        $GLOBALS['wiki']->DeleteOrphanedPage($_GET['idliste']);
        $sql = 'DELETE FROM '.$GLOBALS['wiki']
            ->config['table_prefix'].'triples '.'WHERE resource = "'.
        htmlspecialchars($_GET['idliste'], ENT_COMPAT |
            ENT_HTML401, YW_CHARSET).'" ';
        $GLOBALS['wiki']->Query($sql);

        // Envoie d un mail aux administrateurs
        if ($GLOBALS['wiki']->config['BAZ_ENVOI_MAIL_ADMIN']) {
            include_once 'tools/contact/libs/contact.functions.php';
            $lien = str_replace('/wakka.php?wiki=', '', $GLOBALS['wiki']->config['base_url']);
            $sujet = removeAccents('['.str_replace('http://', '', $lien).'] liste supprimee : '.$_GET['idliste']);
            $text =
            'IP utilisee : '.$_SERVER['REMOTE_ADDR'].' ('.
            $GLOBALS['wiki']->GetUserName().')';
            $texthtml = $text;
            $fichier = 'tools/bazar/presentation/styles/bazar.css';
            $style = file_get_contents($fichier);
            $style = str_replace('url(', 'url('.$lien.'/tools/bazar/presentation/', $style);
            $html =
            '<html><head><style type="text/css">'.$style.
            '</style></head><body>'.$texthtml.'</body></html>';

            //on va chercher les admins
            $requeteadmins = 'SELECT value FROM '.$GLOBALS['wiki']
                ->config['table_prefix'].

            'triples WHERE resource="ThisWikiGroup:admins" AND property="http://www.wikini.net/_vocabulary/acls" LIMIT 1';
            $ligne = $GLOBALS['wiki']->LoadSingle($requeteadmins);
            $tabadmin = explode("\n", $ligne['value']);
            foreach ($tabadmin as $line) {
                $admin = $GLOBALS['wiki']->LoadUser(trim($line));
                send_mail($GLOBALS['wiki']->config['BAZ_ADRESSE_MAIL_ADMIN'], $GLOBALS['wiki']->config['BAZ_ADRESSE_MAIL_ADMIN'], $admin['email'], $sujet, $text, $html);
            }
        }

        //on redirige vers la page contenant toutes les listes, avec un message de confirmation
        // $GLOBALS['wiki']->SetMessage(_t('BAZ_LISTES_SUPPRIMEES'));
        $GLOBALS['wiki']->Redirect(
            $GLOBALS['wiki']->href($iframe, $GLOBALS['wiki']->GetPageTag(), BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_LISTES, false)
        );
    }

    return $res;
}

/** baz_valeurs_fiche() - Renvoie un tableau avec les valeurs par defaut du formulaire d'inscription
 * @param    string Identifiant de la fiche
 *
 * @return array Valeurs enregistrees pour cette fiche
 */
function baz_valeurs_fiche($idfiche = '', $formtab = '')
{
    if ($idfiche != '') {
        $type_page = $GLOBALS['wiki']->GetTripleValue($idfiche, 'http://outils-reseaux.org/_vocabulary/type', '', '');
        //on verifie que la page en question est bien une page wiki
        if ($type_page == 'fiche_bazar') {
            // on recupere une autre version en cas de consultation de l'historique
            $time = isset($_REQUEST['time']) ? $_REQUEST['time'] : '';
            $valjson = $GLOBALS['wiki']->LoadPage($idfiche, $time);

            $tab_valeurs_fiche = json_decode($valjson['body'], true);

            foreach ($tab_valeurs_fiche as $key => $value) {
                $valeurs_fiche[$key] = _convert($value, 'UTF-8');
            }

            //cas ou on ne trouve pas les valeurs id_fiche et id_typeannonce
            if (!isset($valeurs_fiche['id_fiche'])) {
                $valeurs_fiche['id_fiche'] = $idfiche;
            }
            if (!isset($valeurs_fiche['id_typeannonce'])) {
                $valeurs_fiche['id_typeannonce'] =
                $valeurs_fiche['id_typeannonce'];
            }

            // on ajoute des attributs html pour tous les champs qui pourraient faire des filtres)
            $valeurs_fiche['html_data'] = getHtmlDataAttributes($valeurs_fiche, $formtab);

            return $valeurs_fiche;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/** baz_valeurs_liste() - Renvoie un tableau avec les valeurs d'une liste
 * @param    string NomWiki de la liste
 *
 * @return array Valeurs enregistrees pour cette liste
 */
function baz_valeurs_liste($idliste = '')
{
    $idliste = trim($idliste);
    if ($idliste != '') {
        if (!isset($GLOBALS['_BAZAR_']['lists'][$idliste])) {
            // on verifie que la page en question est bien une page wiki
            if ($GLOBALS['wiki']->GetTripleValue($idliste, 'http://outils-reseaux.org/_vocabulary/type', '', '') == 'liste') {
                $valjson = $GLOBALS['wiki']->LoadPage($idliste);
                $valeurs_fiche = json_decode($valjson['body'], true);
                if (YW_CHARSET != 'UTF-8') {
                    $GLOBALS['_BAZAR_']['lists'][$idliste]['titre_liste'] = utf8_decode($valeurs_fiche['titre_liste']);
                    if (!isset($_GET['action']) or $_GET['action'] != 'modif_liste') {
                        foreach ($valeurs_fiche['label'] as $key => $val) {
                            $val = utf8_decode($val);
                            preg_match_all('/<span data-lang="'.$GLOBALS['prefered_language'].'">(.*)<\/span>/Ui', $val, $matches);
                            if (!empty($matches[1])) {
                                $GLOBALS['_BAZAR_']['lists'][$idliste]['label'][$key] = $matches[1][0];
                            } else {
                                $GLOBALS['_BAZAR_']['lists'][$idliste]['label'][$key] = $val;
                            }
                        }
                    } else {
                        $GLOBALS['_BAZAR_']['lists'][$idliste]['label'] = array_map('utf8_decode', $valeurs_fiche['label']);
                    }
                } else {
                    if (!isset($_GET['action']) or $_GET['action'] != 'modif_liste') {
                        foreach ($valeurs_fiche['label'] as $key => $val) {
                            preg_match_all('/<span data-lang="'.$GLOBALS['prefered_language'].'">(.*)<\/span>/Ui', $val, $matches);
                            if (!empty($matches[1])) {
                                $valeurs_fiche['label'][$key] = $matches[1][0];
                            } else {
                                $valeurs_fiche['label'][$key] = $val;
                            }
                        }
                    }
                    $GLOBALS['_BAZAR_']['lists'][$idliste] = $valeurs_fiche;
                }
            } else {
                return false;
            }
        }

        return $GLOBALS['_BAZAR_']['lists'][$idliste];
    } else {
        $GLOBALS['_BAZAR_']['lists'] = [];
        //requete pour obtenir l'id et le label des listes
        $requete = 'SELECT resource FROM '.$GLOBALS['wiki']->config['table_prefix'].'triples '
          .'WHERE property="http://outils-reseaux.org/_vocabulary/type" AND value="liste" ORDER BY resource';
        $resultat = $GLOBALS['wiki']->LoadAll($requete);

        foreach ($resultat as $ligne) {
            $GLOBALS['_BAZAR_']['lists'][$ligne['resource']] = baz_valeurs_liste($ligne['resource']);
        }

        return $GLOBALS['_BAZAR_']['lists'];
    }
}

/** baz_nextId () Renvoie le prochain identifiant numerique libre d'une table
 *   @param  string  Nom de la table
 *   @param  string  Nom du champs identifiant
 *   @param  mixed   Objet DB de PEAR pour la connexion a la base de donnees
 *
 *   return  integer Le prochain numero d'identifiant disponible
 */
function baz_nextId($table, $colonne_identifiant, $bdd)
{
    $requete = 'SELECT MAX('.$colonne_identifiant.') AS maxi FROM '.
    $table;
    $ligne = $GLOBALS['wiki']->LoadSingle($requete);

    return $ligne['maxi'] + 1;
}

function getHtmlDataAttributes($fiche, $formtab = '')
{
    $datastr = '';
    if (is_array($fiche) && isset($fiche['id_typeannonce'])) {
        $form = isset($formtab[$fiche['id_typeannonce']]) ? $formtab[$fiche['id_typeannonce']] : baz_valeurs_formulaire($fiche['id_typeannonce']);
        foreach ($fiche as $key => $value) {
            if (!empty($value)) {
                if (in_array(
                    $key,
                    array(
                        'bf_latitude',
                        'bf_longitude',
                        'id_typeannonce',
                        'createur',
                        'date_creation_fiche',
                        'date_debut_validite_fiche',
                        'date_fin_validite_fiche',
                        'id_fiche',
                        'statut_fiche',
                        'date_maj_fiche',
                    )
                )) {
                    $datastr .=
                    'data-'.htmlspecialchars($key).'="'.
                    htmlspecialchars($value).'" ';
                } else {
                    if (is_array($form['template'])) {
                        foreach ($form['template'] as $id => $val) {
                            if ($val[1] === $key || (isset($val[6]) &&
                              $val[0].$val[1].$val[6] === $key)) {
                                if (in_array(
                                    $form['template'][$id][0],
                                    array(
                                        'checkbox',
                                        'liste',
                                        'checkboxfiche',
                                        'listefiche',
                                        'tags',
                                        'jour',
                                        'scope',
                                        //'texte'
                                    )
                                )
                                ) {
                                    $datastr .=
                                    'data-'.htmlspecialchars($key).'="'.
                                    htmlspecialchars($value).'" ';
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    return $datastr;
}

/**  show() - Formatte un paragraphe champs d'une fiche seulement si la valeur est renseignée
 * @global string champ de la fiche (au format html)
 * @global string Label du champs (facultatif)
 * @global string classe CSS du paragraphe (facultatif "field" par défaut)
 * @global string balise HTML du paragraphe (facultatif "field" par défaut)
 *
 * @return string HTML
 */
function show($val, $label = '', $class = 'field', $tag = 'p', $fiche = '')
{
    if (is_array($fiche)) {
        // on recupere les valeurs plutot que les clés pour les champs checkbox et liste
        if (substr($val, 0, 10) ===  'listeListe' or substr($val, 0, 13) === 'checkboxListe') {
            $func = (substr($val, 0, 10) ===  'listeListe' ? 'liste' : 'checkbox');
            $dummy = '';
            $form = baz_valeurs_formulaire($fiche['id_typeannonce']);
            $form = multiArraySearch($form, '1', preg_replace('/^(liste|checkbox)/i', '', $val));
            $form = array_shift($form);
            $html = $func($dummy, $form, 'html', $fiche);
            preg_match_all(
                '/<span class="BAZ_texte">\s*(.*)\s*<\/span>/Uim',
                $html,
                $matches
            );
            if (isset($matches[1][0]) && $matches[1][0] != '') {
                $val = $matches[1][0];
            } else {
                $val = '';
            }
        } else {
            $val = isset($fiche[$val]) ? $fiche[$val] : '';
        }
    }
    if (!empty($val)) {
        echo '<'.$tag;
        if (!empty($class)) {
            echo ' class="'.$class.'"';
        }
        echo '>'."\n";
        if (!empty($label)) {
            echo '<strong>'.$label.'</strong> '."\n";
        }
        echo $val.'</'.$tag.'>'."\n";
    }
}

/**  baz_voir_fiche() - Permet de visualiser en detail une fiche  au format XHTML
 * @global boolean Rajoute des informations et la barre d'édition si true
 * @global integer Identifiant de la fiche a afficher ou mixed un tableau avec toutes les valeurs stockees pour la fiche
 *
 * @return string HTML
 */
function baz_voir_fiche($danslappli, $idfiche, $form = '')
{
    //si c'est un tableau avec les valeurs de la fiche
    if (is_array($idfiche)) {
        // on deplace le tableau et on donne la bonne valeur a id fiche
        $fichebazar['values'] = $idfiche;
        $idfiche = $fichebazar['values']['id_fiche'];
        $fichebazar['form'] = (is_array($form) and is_array($form[$fichebazar['values']['id_typeannonce']])) ? $form[$fichebazar['values']['id_typeannonce']] : baz_valeurs_formulaire($fichebazar['values']['id_typeannonce']);
    } else {
        // on recupere les valeurs de la fiche
        $fichebazar['values'] = baz_valeurs_fiche($idfiche);

        // on recupere les infos du type de fiche
        $f = $fichebazar['values']['id_typeannonce'];
        $fichebazar['form'] = is_array($form[$f]) ? $form[$f] : baz_valeurs_formulaire($f);
    }

    $res = '';

    // on traite l'affichage d'éventuels messages
    if (isset($_GET['message'])) {
        $res .= '<div class="alert alert-success">'."\n";
        if ($_GET['message'] == 'ajout_ok') {
            $res .=
            _t('BAZ_FICHE_ENREGISTREE').'  <a href="'.$GLOBALS['wiki']
                ->href(
                    '',
                    $GLOBALS['wiki']->getPageTag(),
                    BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_SAISIR.
                    '&id='
                    .$fichebazar['values']['id_typeannonce']
                ).'" class="pull-right btn-sm btn btn-primary">'.
            _t('BAZ_ADD_NEW_ENTRY').'</a>';
        }
        if ($_GET['message'] == 'modif_ok') {
            $res .= _t('BAZ_FICHE_MODIFIEE').'  <a href="'.$GLOBALS['wiki']
                ->href(
                    '',
                    $GLOBALS['wiki']->getPageTag(),
                    BAZ_VARIABLE_VOIR.'='.BAZ_VOIR_SAISIR.
                    '&id_typeannonce='.
                    $fichebazar['values']['id_typeannonce']
                ).'" class="pull-right btn-sm btn btn-primary">'.
            _t('BAZ_ADD_MODIFY_ENTRY_AGAIN').'</a>';
        }
        $res .= '<div class="clearfix"></div></div>'."\n";
    }

    // fake ->tag pour les images attachees
    $oldpage = $GLOBALS['wiki']->GetPageTag();
    $GLOBALS['wiki']->tag = $idfiche;


    // debut de la fiche
    $res .= '<div class="BAZ_cadre_fiche id'.
    $fichebazar['form']['bn_id_nature'].'">'."\n";

    // si un template specifique pour un type de fiche existe
    if (file_exists('themes/tools/bazar/templates/fiche-'.
      $fichebazar['values']['id_typeannonce'].'.tpl.html')) {
        // on genere un nom unique pour le cache
        $cacheid = $GLOBALS['wiki']->generateCacheId(
            'bazar',
            'fiche-'.$fichebazar['values']['id_typeannonce'].'.tpl.html',
            strtotime($fichebazar['values']['date_maj_fiche'])
        );

        if ($GLOBALS['wiki']->isTemplateCached($cacheid)) {
          $fp = @fopen($cacheid, 'r');
          $res .= fread($fp, filesize($cacheid));
          fclose($fp);
        } else {
          $html = $formtemplate = [];
          for ($i = 0; $i < count($fichebazar['form']['template']); ++$i) {
              // Champ  acls  present
              if (isset($fichebazar['form']['template'][$i][11]) &&
                  $fichebazar['form']['template'][$i][11] != '' &&
                  !$GLOBALS['wiki']
                  ->CheckACL($fichebazar['form']['template'][$i][11])) {
                  // Non autorise : non ne fait rien
              } else {
                  if ($fichebazar['form']['template'][$i][0] != 'labelhtml' &&
                      function_exists($fichebazar['form']['template'][$i][0])) {
                      if ($fichebazar['form']['template'][$i][0] == 'checkbox' ||
                          $fichebazar['form']['template'][$i][0] == 'liste' ||
                          $fichebazar['form']['template'][$i][0] ==
                          'checkboxfiche' ||
                          $fichebazar['form']['template'][$i][0] ==
                          'listefiche') {
                          $id =
                          $fichebazar['form']['template'][$i][0].
                          $fichebazar['form']['template'][$i][1].
                          $fichebazar['form']['template'][$i][6];
                      } elseif ($fichebazar['form']['template'][$i][0] == 'fichier' or $fichebazar['form']['template'][$i][0] == 'image') {
                          $id = $fichebazar['form']['template'][$i][0].$fichebazar['form']['template'][$i][1];
                      } else {
                          $id = $fichebazar['form']['template'][$i][1];
                      }
                      $html[$id] = $fichebazar['form']['template'][$i][0](
                          $formtemplate,
                          $fichebazar['form']['template'][$i],
                          'html',
                          $fichebazar['values']
                      );
                      preg_match_all(
                          '/<span class="BAZ_texte">\s*(.*)\s*<\/span>/Uim',
                          $html[$id],
                          $matches
                      );
                      if (isset($matches[1][0]) && $matches[1][0] != '') {
                          $html[$id] = $matches[1][0];
                      }
                  }

              }
          }
          $fiche['html'] = $html;
          $fiche['fiche'] = $fichebazar['values'];
          $fiche['form'] = $fichebazar['form'];
          $res .= $GLOBALS['wiki']->renderTemplate(
              'bazar',
              'fiche-'.$fichebazar['values']['id_typeannonce'].'.tpl.html',
              $fiche,
              strtotime($fichebazar['values']['date_maj_fiche'])
          );
        }
    } else {
        for ($i = 0; $i < count($fichebazar['form']['template']); ++$i) {
            if (isset($fichebazar['form']['template'][$i][11]) &&
                $fichebazar['form']['template'][$i][11] != '') {
                // Champ  acls  present
                if (!$GLOBALS['wiki']
                    ->CheckACL($fichebazar['form']['template'][$i][11])) {
                    // Non autorise : non ne fait rien
                } else {
                    // Mauvais style de programmation ...
                    if (function_exists($fichebazar['form']['template'][$i][0])) {
                        $res .= $fichebazar['form']['template'][$i][0](
                            $formtemplate,
                            $fichebazar['form']['template'][$i],
                            'html',
                            $fichebazar['values']
                        );
                    }
                }
            } else {
                if (function_exists($fichebazar['form']['template'][$i][0])) {
                    $res .= $fichebazar['form']['template'][$i][0](
                        $formtemplate,
                        $fichebazar['form']['template'][$i],
                        'html',
                        $fichebazar['values']
                    );
                }
            }
        }
    }
    $fichebazar['infos'] = '';

    // informations complementaires (id fiche, etat publication,... )
    if ($danslappli === true) {
        $fichebazar['infos'] .=
        '<div class="BAZ_fiche_info well well-sm">'."\n";

        // obsolète : seul le createur ou un admin peut faire des actions sur la fiche
        //if (baz_a_le_droit('saisie_fiche', $GLOBALS['wiki']->GetPageOwner($idfiche))) {
        //
        // L'utilisateur a-t-il le droit en écriture ?
        if ($GLOBALS['wiki']->HasAccess('write', $idfiche)) {
            $fichebazar['infos'] .=
                '<div class="pull-right BAZ_actions_fiche">'."\n"
                // lien modifier la fiche
                . '<a class="btn btn-xs btn-mini btn-default" href="'
                . $GLOBALS['wiki']->href('edit', $idfiche).'">'
                . '<i class="glyphicon glyphicon-pencil icon-pencil"></i> '
                . _t('BAZ_MODIFIER')
                .'</a>'."\n";

            if ($GLOBALS['wiki']->UserIsAdmin() or $GLOBALS['wiki']->UserIsOwner()) {
                // lien supprimer la fiche
                $fichebazar['infos'] .=
                ' <a class="btn btn-xs btn-mini btn-danger btn-delete-page-confirm" href="'
                . $GLOBALS['wiki']->href('deletepage', $idfiche).'" data-confirm-text="'
                . _t('BAZ_CONFIRM_SUPPRIMER_FICHE').'">'
                . '<i class="glyphicon glyphicon-trash icon-trash icon-white"></i> '
                . _t('BAZ_SUPPRIMER').'</a>'."\n";
            }

            // TODO ajouter action de validation (pour les admins)
            // if (baz_a_le_droit('valider_fiche')) {
            //     if ($fichebazar['values']['statut_fiche'] == 0 ||
            //         $fichebazar['values']['statut_fiche'] == 2) {
            //         $lien_publie = $GLOBALS['wiki']->href(
            //             '',
            //             '',
            //             BAZ_VARIABLE_VOIR . '=' . BAZ_VOIR_SAISIR . '&' .
            //             'id_fiche=' . $idfiche
            //             . '&' . BAZ_VARIABLE_ACTION . '=' . BAZ_ACTION_PUBLIER
            //         );
            //         $label_publie = _t('BAZ_VALIDER_LA_FICHE');
            //         $class_publie = '_valider';
            //     } elseif ($fichebazar['values']['statut_fiche'] == 1) {
            //         $lien_publie = $GLOBALS['wiki']->href(
            //             '',
            //             '',
            //             BAZ_VARIABLE_VOIR . '=' . BAZ_VOIR_SAISIR . '&' .
            //             'id_fiche=' . $idfiche
            //             . '&' . BAZ_VARIABLE_ACTION . '=' .
            //             BAZ_ACTION_PAS_PUBLIER
            //         );
            //         $label_publie = _t('BAZ_INVALIDER_LA_FICHE');
            //         $class_publie = '_invalider';
            //     }
            //     $fichebazar['infos'] .=
            //     '<li><a class="btn btn-xs btn-mini btn-default BAZ_lien' .
            //     $class_publie
            //     . '" href="' . $lien_publie . '">' . $label_publie .
            //     '</a></li>' . "\n";
            // }

            $fichebazar['infos'] .=
            '</div><!-- /.BAZ_actions_fiche -->'."\n";
        }

        // affichage du nom de la PageWiki de la fiche et de son proprietaire
        $fichebazar['infos'] .= $GLOBALS['wiki']->Format($idfiche)

        .' <span class="category">('.$fichebazar['form']['bn_label_nature']
        .')</span>'
        .(($GLOBALS['wiki']->GetPageOwner($idfiche) != '') ?
            ', '._t('BAZ_ECRITE').' '
            .$GLOBALS['wiki']->GetPageOwner($idfiche) : '');

        // affichage des infos et du lien pour la mise a jour de la fiche
        $fichebazar['infos'] .=
        '<br><small><span class="date_creation">'._t('BAZ_DATE_CREATION').' '
        .strftime('%d.%m.%Y &agrave; %H:%M', strtotime($fichebazar['values']['date_creation_fiche'])).
        '</span>';
        $fichebazar['infos'] .=
        ', <span class="date_mise_a_jour">'._t('BAZ_DATE_MAJ').' '
        .strftime('%d.%m.%Y &agrave; %H:%M', strtotime($fichebazar['values']['date_maj_fiche'])).'</span>.</small>';

        $fichebazar['infos'] .= '</div><!-- /.BAZ_fiche_info -->'."\n";
    }
    $res .= $fichebazar['infos'];

    // fin de la fiche
    $res .= '</div><!-- /.BAZ_cadre_fiche  -->'."\n";

    // fake ->tag pour les images attachees
    $GLOBALS['wiki']->tag = $oldpage;

    return $res;
}

/**
 * TODO: remove this method and use Wakka::HasAccess()
 * @deprecated: use Wakka::HasAccess()
 *
 * baz_a_le_droit() Renvoie true si la personne a le droit d'acceder a la fiche
 *   @param  string  type de demande (voir, saisir, modifier)
 *   @param  string  identifiant, soit d'un formulaire, soit d'une fiche, soit d'un type de fiche
 *
 *   return  boolean    vrai si l'utilisateur a le droit, faux sinon
 */
function baz_a_le_droit($demande = 'saisie_fiche', $id = '')
{

    //cas d'une personne identifiee
    $nomwiki = $GLOBALS['wiki']->getUser();

    //l'administrateur peut tout faire
    if ($GLOBALS['wiki']->UserIsInGroup('admins')) {
        return true;
    } else {
        if ($demande == 'supp_fiche') {
            // seuls admins et createur peuvent effacer une fiche
            if (is_array($nomwiki) && $id == $nomwiki['name'] || $id == '') {
                return true;
            } else {
                return false;
            }
        }
        if ($demande == 'voir_champ') {
            // seuls admins et createur peuvent voir un champ protege
            if (is_array($nomwiki) && $id == $nomwiki['name'] || $id == '') {
                return true;
            } else {
                return false;
            }
        }
        if ($demande == 'modif_fiche') {
            // pour la modif d'une fiche : ouvert a tous
            return true;
        }
        if ($demande == 'saisie_fiche') {
            // pour la saisie d'une fiche, ouvert a tous
            return true;
        } elseif ($demande == 'valider_fiche') {
            //pour la validation d'une fiche, pour l 'instant seul les admins peuvent valider une fiche
            return false;
        } elseif ($demande == 'saisie_formulaire' || $demande ==
            'saisie_liste') {
            //pour la saisie d'un formulaire ou d'une liste, pour l 'instant seul les admins ont le droit
            return false;
        } elseif ($demande == 'voir_mes_fiches') {
            //pour la liste des fiches saisies, il suffit d'ÃƒÂªtre identifie
            return true;
        } else {
            //les autres demandes sont reservees aux admins donc non!
            return false;
        }
    }
}

/** removeAccents() Renvoie une chaine de caracteres avec les accents en moins
 *   @param  string  chaine de caracteres avec de potentiels accents a enlever
 *
 *   return  string chaine de caracteres, sans accents
 */
function removeAccents($str, $charset = YW_CHARSET)
{
    $str = htmlentities($str, ENT_NOQUOTES, $charset);
    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

    return $str;
}

/** genere_nom_wiki()
 *  Prends une chaine de caracteres, et la tranforme en NomWiki unique, en la limitant
 *  a 50 caracteres et en mettant 2 majuscules
 *  Si le NomWiki existe deja, on propose recursivement NomWiki2, NomWiki3, etc..
 *
 *   @param  string  chaine de caracteres avec de potentiels accents a enlever
 *   @param int nombre d'iteration pour la fonction recursive (1 par defaut)
 *
 *
 *   return  string chaine de caracteres, en NomWiki unique
 */
function genere_nom_wiki($nom, $occurence = 1)
{

    // si la fonction est appelee pour la premiere fois, on nettoie le nom passe en parametre
    if ($occurence <= 1) {
        // les noms wiki ne doivent pas depasser les 50 caracteres, on coupe a 48
        // histoire de pouvoir ajouter un chiffre derriere si nom wiki deja existant
        // plus traitement des accents et ponctuation
        // plus on met des majuscules au debut de chaque mot et on fait sauter les espaces
        $temp = removeAccents(mb_substr(preg_replace('/[[:punct:]]/', ' ', $nom), 0, 47, YW_CHARSET));
        $temp = explode(' ', ucwords(strtolower($temp)));
        $nom = '';
        foreach ($temp as $mot) {
            // on vire d'eventuels autres caracteres speciaux
            $nom .= preg_replace('/[^a-zA-Z0-9]/', '', trim($mot));
        }

        // on verifie qu'il y a au moins 2 majuscules, sinon on en rajoute une a la fin
        $var = preg_replace('/[^A-Z]/', '', $nom);
        if (strlen($var) < 2) {
            $last = ucfirst(substr($nom, strlen($nom) - 1));
            $nom = substr($nom, 0, -1).$last;
        }

        $nom = '';
        foreach ($temp as $mot) {
            // on vire d'eventuels autres caracteres speciaux
            $nom .= preg_replace('/[^a-zA-Z0-9]/', '', trim($mot));
        }

        // on verifie qu'il y a au moins 2 majuscules, sinon on en rajoute une a la fin
        $var = preg_replace('/[^A-Z]/', '', $nom);
        if (strlen($var) < 2) {
            $last = ucfirst(substr($nom, strlen($nom) - 1));
            $nom = substr($nom, 0, -1).$last;
        }
    } elseif ($occurence > 2) {
        // si on en est a plus de 2 occurences, on supprime le chiffre precedent et on ajoute la nouvelle occurence
        $nb = -1 * strlen(strval($occurence - 1));
        $nom = substr($nom, 0, $nb).$occurence;
    } else {
        // cas ou l'occurence est la deuxieme : on reprend le NomWiki en y ajoutant le chiffre 2
        $nom = $nom.$occurence;
    }

    if ($occurence == 0) {
        // pour occurence = 0 on ne teste pas l'existance de la page
        return $nom;
    } elseif (!is_array($GLOBALS['wiki']->LoadPage($nom))) {
        // on verifie que la page n'existe pas deja : si c'est le cas on le retourne
        return $nom;
    } else {
        // sinon, on rappele recursivement la fonction jusqu'a ce que le nom aille bien
        ++$occurence;

        return genere_nom_wiki($nom, $occurence);
    }
}

/** baz_rechercher() Formate la liste de toutes les fiches
 *   @return  string    le code HTML a afficher
 */
function baz_rechercher($typeannonce = '', $categorienature = '')
{
    if (!isset($GLOBALS['_BAZAR_']['nbbazarsearch'])) {
        $GLOBALS['_BAZAR_']['nbbazarsearch'] = 0;
    }
    ++$GLOBALS['_BAZAR_']['nbbazarsearch'];

    $res = '';

    // parametres complémentaires de l'url (vont etre passés en GET)
    $data['vue'] = BAZ_VOIR_CONSULTER;
    $data['action'] = BAZ_MOTEUR_RECHERCHE;

    $data['query'] = '';
    $first = true;
    if (is_array($GLOBALS['params']['query']) and count($GLOBALS['params']['query'])>0) {
        foreach ($GLOBALS['params']['query'] as $key => $value) {
            if ($first) {
                $first = false;
            } else {
                $data['query'] .= '|';
            }
            $data['query'] .= $key.'='.$value;
        }
    }


    $data['facette'] = '';
    if (isset($_GET['facette']) && !empty($_GET['facette'])) {
        $data['facette'] = $_GET['facette'];
    }

    // creation du lien pour le formulaire de recherche
    $data['url'] = $GLOBALS['wiki']->href('', $GLOBALS['wiki']->GetPageTag());

    // on recupere la liste des formulaires, a afficher dans une liste deroulante pour la recherche
    $tab_formulaires = baz_valeurs_formulaire($typeannonce, $categorienature);

    // on recupere le nb de types de fiches, pour plus tard
    $nb_type_de_fiches = 0;
    $type_fiche = '';
    $type_formulaire_select[''] = _t('BAZ_TOUS_TYPES_FICHES');
    if (is_array($tab_formulaires) and !isset($tab_formulaires["bn_id_nature"])) {
        foreach ($tab_formulaires as $nomwiki => $ligne) {
            ++$nb_type_de_fiches;
            $tableau_typeformulaires[] = $nomwiki;
            $type_formulaire_select[$nomwiki] = $ligne['bn_label_nature'].
            ((!empty($type_fiche)) ? ' ('.$type_fiche.')' : '');
        }
    } elseif (isset($tab_formulaires["bn_id_nature"])) {
        $nb_type_de_fiches = 1;
        unset($type_formulaire_select);
        $data['forms'] = '';
    }
    if ($nb_type_de_fiches > 1 and !in_array("id_typeannonce", $GLOBALS['params']['groups'])) {
        $data['forms'] = $type_formulaire_select;
    } else {
        $data['forms'] = '';
    }
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $data['idform'] = $_GET['id'];
    } elseif (is_array($typeannonce) && count($typeannonce) == 1) {
        $data['idform'] = $typeannonce[0];
    } else {
        $data['idform'] = '';
    }

    $data['wiki'] = $_GET['wiki'];

    // y a t'il des mots clés pour le moteur de recherche
    $data['search'] = '';
    if (isset($_REQUEST['q']) && !empty($_REQUEST['q'])) {
        $data['search'] = $_REQUEST['q'];
    }

    // affichage du formulaire
    include_once 'includes/squelettephp.class.php';
    $res .= '<div id="bazar-search-'.$GLOBALS['_BAZAR_']['nbbazarsearch'].'">';
    include_once 'includes/squelettephp.class.php';
    try {
        $squel = new SquelettePhp('search_form.tpl.html', 'bazar');
        $res .=  $squel->render($data);
    } catch (Exception $e) {
        $res .= '<div class="alert alert-danger">Erreur template search_form.tpl.html : '.$e->getMessage().'</div>'."\n";
    }

    $fiches = baz_requete_recherche_fiches(
        $GLOBALS['params']['query'],
        '',
        $data['idform'],
        $categorienature,
        1,
        '',
        '',
        true,
        $data['search']
    );
    $shownbres = count($GLOBALS['params']['groups']) == 0 || count($fiches) == 0;
    $res .= displayResultList($fiches, $GLOBALS['params'], $shownbres).'</div>';
    return $res;
}


/** formulaire_valeurs_template_champs() - Decoupe le template et renvoie un tableau structure
 *
 * @param    string  Template du formulaire
 * @return   mixed   Le tableau des elements du formulaire et options pour l'element liste
 */
function formulaire_valeurs_template_champs($template)
{
    //Parcours du template, pour mettre les champs du formulaire avec leurs valeurs specifiques
    $tableau_template = array();
    $nblignes = 0;

    //on traite le template ligne par ligne
    $chaine = explode("\n", $template);
    foreach ($chaine as $ligne) {
        $ligne = trim($ligne);
        // on ignore les lignes vides ou commencant par # (commentaire)
        if (!empty($ligne) && !(strrpos($ligne, '#', -strlen($ligne)) !== false)) {
            //on decoupe chaque ligne par le separateur *** (c'est historique)
            $tablignechampsformulaire = array_map("trim", explode("***", $ligne));
            if (function_exists($tablignechampsformulaire[0])) {
                if (count($tablignechampsformulaire) > 3) {
                    $tableau_template[$nblignes] = $tablignechampsformulaire;
                    for ($i=0; $i < 14; $i++) {
                        if (!isset($tableau_template[$nblignes][$i])) {
                            $tableau_template[$nblignes][$i] = '';
                        }
                    }
                    $nblignes++;
                }
            }
        }
    }

    return $tableau_template;
}


/**
 * Cette fonction recupere tous les parametres passes pour la recherche, et retourne un tableau de valeurs des fiches.
 */
function baz_requete_recherche_fiches(
    $tableau_criteres = '',
    $tri = '',
    $id = '',
    $categorie_fiche = '',
    $statut = 1,
    $personne = '',
    $nb_limite = '',
    $motcles = true,
    $q = '',
    $facettesearch = 'OR'
) {
    //requete pour recuperer toutes les PageWiki etant des fiches bazar
    $requete_pages_wiki_bazar_fiches =
    'SELECT DISTINCT resource FROM '.$GLOBALS['wiki']->config['table_prefix'].'triples '.
    'WHERE value = "fiche_bazar" AND property = "http://outils-reseaux.org/_vocabulary/type" '.
    'ORDER BY resource ASC';

    $requete =
    'SELECT DISTINCT * FROM '.$GLOBALS['wiki']->config['table_prefix'].
    'pages WHERE latest="Y" AND comment_on = \'\'';

    //on limite au type de fiche
    if (!empty($id)) {
        if (is_array($id)) {
            if (count($id) == 1) {
                // on a qu'un id dans le tableau
                $id = array_shift($id);
                $requete .= ' AND body LIKE \'%"id_typeannonce":"'.$id.'"%\'';
            } else {
                // on a plusieurs id dans le tableau
                $requete .= ' AND ';
                $first = true;
                foreach ($id as $formid) {
                    if ($first) {
                        $first = false;
                    } else {
                        $requete .= ' OR ';
                    }
                    $requete .= 'body LIKE \'%"id_typeannonce":"'.$formid.'"%\'';
                }
            }
        } else {
            // on a une chaine de caractere pour l'id plutot qu'un tableau
            $requete .= ' AND body LIKE \'%"id_typeannonce":"'.$id.'"%\'';
        }
    }

    //statut de validation
    $requete .= ' AND body LIKE \'%"statut_fiche":"'.$statut.'"%\'';

    // periode de modification
    if (!empty($GLOBALS['params']['datemin'])) {
        $requete .= ' AND time >= "'.$GLOBALS['params']['datemin'].'"';
    }

    //si une personne a ete precisee, on limite la recherche sur elle
    if ($personne != '') {
        $personne = mysqli_escape_string(
            $GLOBALS['wiki']->dblink,
            preg_replace('/^"(.*)"$/', '$1', json_encode($personne))
        );
        // WTF : https://stackoverflow.com/questions/13287145/mysql-querying-for-unicode-entities#13327605
        $personne = str_replace('\\u00', '\\\\\u00', $personne);
        $requete .= ' AND body LIKE _utf8\'%"createur":"'.$personne.'"%\'';
    }

    $requete .= ' AND tag IN ('.$requete_pages_wiki_bazar_fiches.')';

    $requeteSQL = '';
    //preparation de la requete pour trouver les mots cles
    if (trim($q) != '' && $q !=_t('BAZ_MOT_CLE')) {
        $GLOBALS['wiki']->Query("SET sql_mode = 'NO_BACKSLASH_ESCAPES';");
        $search = str_replace(array('["', '"]'), '', json_encode(array(removeAccents($q))));
        $recherche = explode(' ', $search);
        $nbmots = count($recherche);
        $requeteSQL .= ' AND (';
        for ($i = 0; $i < $nbmots; ++$i) {
            if ($i > 0) {
                $requeteSQL .= ' OR ';
            }
            $requeteSQL .= ' body LIKE \'%'.mysqli_escape_string($GLOBALS['wiki']->dblink, $recherche[$i]).'%\'';
        }
        $requeteSQL .= ')';
    }
    //on ajoute dans la requete les valeurs passees dans les champs liste et checkbox du moteur de recherche
    if ($tableau_criteres == '') {
        $tableau_criteres = array();

        // on transforme les specifications de recherche sur les liste et checkbox
        if (isset($_REQUEST['rechercher'])) {
            reset($_REQUEST);

            foreach ($_REQUEST as $nom => $val) {
                if (((substr($nom, 0, 5) == 'liste') || (substr($nom, 0, 8) ==
                    'checkbox')) && $val != '0' && $val != '') {
                    if (is_array($val)) {
                        $val = implode(',', array_keys($val));
                    }
                    $tableau_criteres[$nom] = $val;
                }
            }
        }
    }

    // cas des criteres passés en parametres get
    if (isset($_GET['query'])) {
        $query = $_GET['query'];
        $tableau = array();
        $tab = explode('|', $query);
        //découpe la requete autour des |
        foreach ($tab as $req) {
            $tabdecoup = explode('=', $req, 2);
            if (count($tabdecoup)>1) {
                $tableau[$tabdecoup[0]] = trim($tabdecoup[1]);
            }
        }
        $tableau_criteres = array_merge($tableau_criteres, $tableau);
    }

    if ($motcles == true) {
        reset($tableau_criteres);
        foreach ($tableau_criteres as $nom => $val) {
            if (!empty($nom) && !empty($val)) {
                $valcrit = explode(',', $val);
                if (is_array($valcrit) && count($valcrit) > 1) {
                    $requeteSQL .= ' AND (';
                    $first = true;
                    foreach ($valcrit as $critere) {
                        if (!$first) {
                            $requeteSQL .= ' '.$facettesearch.' ';
                        }

                        if (strcmp(substr($nom, 0, 5), 'liste') == 0) {
                            $requeteSQL .=
                            'body REGEXP \'"'.$nom.'":"'.$critere.'"\'';
                        } else {
                            $requeteSQL .=
                            'body REGEXP \'"'.$nom.'":("'.$critere.
                            '"|"[^"]*,'.$critere.'"|"'.$critere.',[^"]*"|"[^"]*,'
                            .$critere.',[^"]*")\'';
                        }

                        $first = false;
                    }
                    $requeteSQL .= ')';
                } else {
                    if (strcmp(substr($nom, 0, 5), 'liste') == 0) {
                        $requeteSQL .=
                        ' AND (body REGEXP \'"'.$nom.'":"'.$val.'"\')';
                    } else {
                        $requeteSQL .=
                        ' AND (body REGEXP \'"'.$nom.'":("'.$val.
                        '"|"[^"]*,'.$val.'"|"'.$val.',[^"]*"|"[^"]*,'
                        .$val.',[^"]*")\')';
                    }
                }
            }
        }
    }

    // requete de jointure : reprend la requete precedente et ajoute des criteres
    if (isset($_GET['joinquery'])) {
        $joinrequeteSQL = '';
        $tableau = array();
        $tab = explode('|', $_GET['joinquery']);
        //découpe la requete autour des |
        foreach ($tab as $req) {
            $tabdecoup = explode('=', $req, 2);
            $tableau[$tabdecoup[0]] = trim($tabdecoup[1]);
        }
        $first = true;

        foreach ($tableau as $nom => $val) {
            if (!empty($nom) && !empty($val)) {
                $valcrit = explode(',', $val);
                if (is_array($valcrit) && count($valcrit) > 1) {
                    foreach ($valcrit as $critere) {
                        if (!$first) {
                            $joinrequeteSQL .= ' AND ';
                        } else {
                            $first = false;
                        }
                        $joinrequeteSQL .=
                        '(body REGEXP \'"'.$nom.'":"[^"]*'.$critere.
                        '[^"]*"\')';
                    }
                    $joinrequeteSQL .= ')';
                } else {
                    if (!$first) {
                        $joinrequeteSQL .= ' AND ';
                    } else {
                        $first = false;
                    }
                    if (strcmp(substr($nom, 0, 5), 'liste') == 0) {
                        $joinrequeteSQL .=
                        '(body REGEXP \'"'.$nom.'":"'.$val.'"\')';
                    } else {
                        $joinrequeteSQL .=
                        '(body REGEXP \'"'.$nom.'":("'.$val.
                        '"|"[^"]*,'.$val.'"|"'.$val.',[^"]*"|"[^"]*,'
                        .$val.',[^"]*")\')';
                    }
                }
            }
        }
        if ($requeteSQL != '') {
            $requeteSQL .= ' UNION
            '.$requete.' AND ('.$joinrequeteSQL.')';
        } else {
            $requeteSQL .= ' AND ('.$joinrequeteSQL.')';
        }
        $requete .= $requeteSQL;
    } elseif ($requeteSQL != '') {
        $requete .= $requeteSQL;
    }

    // systeme de cache des recherches
    $reqid = 'bazar-search-'.md5($requete);
    // debug
    if (isset($_GET['showreq'])) {
        echo '<hr><code style="width:100%;height:100px;">'.$requete.'</code><hr>';
    }
    if (!isset($GLOBALS['_BAZAR_'][$reqid])) {
        $GLOBALS['_BAZAR_'][$reqid] = $GLOBALS['wiki']->LoadAll($requete);
    }
    return $GLOBALS['_BAZAR_'][$reqid];
}

/**
 * Mets dans le cache une url .
 *
 * @param $url : url a mettre en cache
 * @param $cache_life : booleen pour afficher ou non le nombre  du resultat de la recherche (vrai par defaut)
 *
 * @return string location of cached file
 */
function cacheUrl($url, $cache_life = '60', $dir = 'cache')
{
    $cache_file = $dir.'/'.removeAccents(preg_replace('/--+/u', '-', preg_replace('/[[:punct:]]/', '-', $url)));

    $filemtime = @filemtime($cache_file);  // returns FALSE if file does not exist
    if (!$filemtime or (time() - $filemtime >= $cache_life)) {
        file_put_contents($cache_file, file_get_contents($url));
    }
    return $cache_file;
}

/**
 * Renvoie le contenu d une url en cache.
 *
 * @param $url : url a mettre en cache
 * @param $cache_life : booleen pour afficher ou non le nombre  du resultat de la recherche (vrai par defaut)
 */
function getCachedUrlContent($url, $cache_life = '60')
{
    $cache_file = cacheUrl($url, $cache_life);
    return file_get_contents($cache_file);
}

/*
 * filtering an array
 */
function filterByValue($array, $index, $value)
{
    $newarray = array();
    if (is_array($array) && count($array)>0) {
        foreach (array_keys($array) as $key) {
            $temp[$key] = isset($array[$key][$index]) ? $array[$key][$index] : null;
            if (is_array($value)) {
                if (in_array($temp[$key], $value)) {
                    $newarray[$key] = $array[$key];
                }
            } elseif ($temp[$key] == $value) {
                $newarray[$key] = $array[$key];
            }
        }
    }
    return $newarray;
}
function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return (substr($haystack, 0, $length) === $needle);
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

/**
 * Génére un tableau avec les informations sur les facettes
 * @param  array $fiches tableau des fiches trouvées
 * @param  array $params tableau des parametres passés a l'action
 * @param  array $formtab tableau des formulaires associés aux fiches si dispo (facultatif)
 * @param  bool  $onlyLists scanne les listes seulement (false par defaut)
 * @return array         tableau des statistiques des données des facettes
 */
function scanAllFacettable($fiches, $params, $formtab = '', $onlyLists = false)
{
    $facettevalue = $templatef = [];

    foreach ($fiches as $fiche) {
        // on recupere les valeurs du formulaire si elles n'existaient pas
        $valform = isset($formtab[$fiche['id_typeannonce']]) ? $formtab[$fiche['id_typeannonce']] : baz_valeurs_formulaire($fiche['id_typeannonce']);
        // on filtre pour n'avoir que les liste, checkbox, listefiche ou checkboxfiche
        $templatef[$fiche['id_typeannonce']] = isset($templatef[$fiche['id_typeannonce']]) ? $templatef[$fiche['id_typeannonce']] : filterByValue(
            $valform['prepared'],
            'id',
            $params['groups']
        );
        foreach ($fiche as $key => $value) {
            $facetteasked = (isset($params['groups'][0]) && $params['groups'][0] == 'all')
              || in_array($key, $params['groups']);
            if (!empty($value) and is_array($templatef[$fiche['id_typeannonce']]) && $facetteasked) {
                $val = filterByValue($templatef[$fiche['id_typeannonce']], 'id', $key);
                $val = array_shift($val);
                $islistforeign = (strpos($val['id'], 'listefiche')===0) || (strpos($val['id'], 'checkboxfiche')===0);
                $islist = in_array($val['type'], array('checkbox', 'select', 'scope', 'radio') ) && !$islistforeign;
                $istext = (!in_array($val['type'], array('checkbox', 'select', 'scope', 'checkboxfiche', 'listefiche')));
                if ($islistforeign) {
                    // listefiche ou checkboxfiche
                    $facettevalue[$val['id']]['type'] = 'fiche';
                    $facettevalue[$val['id']]['source'] = $key;
                    $tabval = explode(',', $value);
                    foreach ($tabval as $tval) {
                        if (isset($facettevalue[$val['id']][$tval])) {
                            ++$facettevalue[$val['id']][$tval];
                        } else {
                            $facettevalue[$val['id']][$tval] = 1;
                        }
                    }
                } elseif ($islist) {
                    $facettevalue[$val['id']]['type'] = 'liste';
                    $facettevalue[$val['id']]['source'] = $val['values']['id'];
                    // liste ou checkbox
                    $tabval = explode(',', $value);
                    foreach ($tabval as $tval) {
                        if (isset($facettevalue[$val['id']][$tval])) {
                            ++$facettevalue[$val['id']][$tval];
                        } else {
                            $facettevalue[$val['id']][$tval] = 1;
                        }
                    }
                } elseif ($istext and !$onlyLists) {
                    // texte
                    $facettevalue[$key]['type'] = 'form';
                    $facettevalue[$key]['source'] = $key;
                    if (isset($facettevalue[$key][$value])) {
                        ++$facettevalue[$key][$value];
                    } else {
                        $facettevalue[$key][$value] = 1;
                    }
                }
            }
        }
    }
    return $facettevalue;
}

function searchResultstoArray($tableau_fiches, $params, $formtab = '')
{
    // tableau qui contiendra les fiches
    $fiches['fiches'] = array();
    $exturl = $GLOBALS['wiki']->GetParameter('url');
    foreach ($tableau_fiches as $fiche) {
        if (isset($fiche['body'])) {
            $fiche = json_decode($fiche['body'], true);
            if (YW_CHARSET != 'UTF-8') {
                $fiche = array_map('utf8_decode', $fiche);
            }
        }
        if (is_array($fiche)) {
            // champs correspondants
            if (!empty($params['correspondance'])) {
                $tabcorrespondances = array();
                $tabcorrespondances = getMultipleParameters($params['correspondance'], ',', '=');
                if ($tabcorrespondances['fail'] != 1){
                    foreach ($tabcorrespondances as $key=>$data) {
                        if (isset($key)) {
                            if (isset($data) && isset($fiche[$data])) {
                                $fiche[$key] = $fiche[$data];
                            } else {
                                $fiche[$key] = '';
                            }
                        } else {
                            echo '<div class="alert alert-danger">action bazarliste : parametre correspondance mal rempli : il doit etre de la forme correspondance="identifiant_1=identifiant_2" ou correspondance="identifiant_1=identifiant_2, identifiant_3=identifiant_4"</div>';
                        }
                    }
                } else {
                    echo '<div class="alert alert-danger">action bazarliste : le paramètre correspondance est mal rempli.<br />Il doit être de la forme correspondance="identifiant_1=identifiant_2" ou correspondance="identifiant_1=identifiant_2, identifiant_3=identifiant_4"</div>';
                }
            }
            $fiche['html_data'] = getHtmlDataAttributes($fiche, $formtab);
            $fiche['datastr'] = $fiche['html_data'];

            // les fiches concernent un wiki externe
            if (isset($exturl)) {
                $arr = explode('/wakka.php', $exturl, 2);
                $exturl = $arr[0];
                $fiche['url'] = $exturl.'/wakka.php?wiki='.$fiche['id_fiche'];
            } else {
                $fiche['url'] = $GLOBALS['wiki']->href('', $fiche['id_fiche']);
            }
            //$fiche['html'] = baz_voir_fiche($params['barregestion'], $fiche);

            // tableau qui contient le contenu de toutes les fiches
            $fiches['fiches'][$fiche['id_fiche']] = $fiche;
        }
    }
    return $fiches['fiches'];
}

/**
 * Affiche la liste des resultats d'une recherche.
 *
 * @param $tableau_fiches : tableau de fiches provenant du resultat de la recherche
 * @param $info_nb : booleen pour afficher ou non le nombre  du resultat de la recherche (vrai par defaut)
 */
function displayResultList($tableau_fiches, $params, $info_nb = true, $formtab = '')
{
    // on compte le nombre de fois que l'action bazarliste est appelée afin de différencier les instances
    if (!isset($GLOBALS['_BAZAR_']['nbbazarliste'])) {
        $GLOBALS['_BAZAR_']['nbbazarliste'] = 0;
    }
    ++$GLOBALS['_BAZAR_']['nbbazarliste'];
    $params['nbbazarliste'] = $GLOBALS['_BAZAR_']['nbbazarliste'];
    $fiches['fiches'] = searchResultstoArray($tableau_fiches, $params, $formtab);
    // tri des fiches
    if ($params['random']) {
        shuffle($fiches['fiches']);
    } else {
        $GLOBALS['ordre'] = $params['ordre'];
        $GLOBALS['champ'] = $params['champ'];
        usort($fiches['fiches'], 'champCompare');
    }

    // Limite le nombre de résultat au nombre de fiches demandées
    if ($params['nb'] != '') {
        $fiches['fiches'] = array_slice($fiches['fiches'], 0, $params['nb']);
    }

    // Tableau des valeurs "facettables" avec leur nombres
    $facettevalue = array();
    // On scanne tous les champs qui pourraient faire des filtres pour les facettes
    if (count($params['groups']) > 0) {
        $facettevalue = scanAllFacettable($fiches['fiches'], $params, $formtab);
    }
    if ($info_nb) {
        $fiches['info_res'] = '<div class="alert alert-info">'._t('BAZ_IL_Y_A');

        $nb_result = count($fiches['fiches']);

        if ($nb_result <= 1) {
            $fiches['info_res'] .= $nb_result.' '._t('BAZ_FICHE').'</div>'."\n";
        } else {
            $fiches['info_res'] .= $nb_result.' '._t('BAZ_FICHES').'</div>'."\n";
        }
    } else {
        $fiches['info_res'] = '';
    }
    $fiches['pager_links'] = '';
    if (!empty($params['pagination'])) {
        // Mise en place du Pager
        require_once 'tools/bazar/libs/vendor/Pager/Pager.php';
        $tab = array_merge($_POST, $_GET);
        // use wiki get param instead of short camelCase param
        if (isset($tab[$GLOBALS['wiki']->getPageTag()])) {
            unset($tab[$GLOBALS['wiki']->getPageTag()]);
            unset($_GET[$GLOBALS['wiki']->getPageTag()]);
        }
        $param = array(
            'mode' => $GLOBALS['wiki']->config['BAZ_MODE_DIVISION'],
            'perPage' => $params['pagination'],
            'delta' => $GLOBALS['wiki']->config['BAZ_DELTA'],
            'httpMethod' => 'GET',
            'path' => $GLOBALS['wiki']->getBaseUrl(),
            'extraVars' => $tab,
            'altNext' => _t('BAZ_SUIVANT'),
            'altPrev' => _t('BAZ_PRECEDENT'),
            'nextImg' => _t('BAZ_SUIVANT'),
            'prevImg' => _t('BAZ_PRECEDENT'),
            'itemData' => $fiches['fiches'],
            'curPageSpanPre' => '<li class="active"><a>',
            'curPageSpanPost' => '</a></li>',
            'useSessions' => false,
            'closeSession' => false,
        );
        $pager = &Pager::factory($param);
        $fiches['fiches'] = $pager->getPageData();
        $fiches['pager_links'] = '<div class="bazar_numero text-center">'."\n".'<ul class="pagination">'."\n".$pager->links.'</ul>'."\n".'</div>'."\n";
    }
    $fiches['param'] = $params;

    // affichage des resultats
    include_once 'includes/squelettephp.class.php';
    try {
        $squel = new SquelettePhp($params['template'], 'bazar');
        $output = '<div id="bazar-list-'.$params['nbbazarliste'].'" class="bazar-list">
    <div class="list">'.$squel->render($fiches).'</div></div>';
    } catch (Exception $e) {
        $output = '<div class="alert alert-danger">Erreur liste fiches : '.$e->getMessage().'</div>'."\n";
    }

    // affichage spécifique pour facette
    if (count($facettevalue) > 0) {
        // affichage des resultats et filtres dans une grille
        $outputfacette = '<div class="facette-container row row-fluid">'."\n";

        // calcul de la largeur de la colonne pour les resultats, en fonction de la taille des filtres
        $resultcolsize = 12 - intval($params['filtercolsize']);

        if ($resultcolsize == 0) {
            $resultcolsize = 12;
        }
        // colonne des resultats
        $outputresult = '<div class="col-xs-'.$resultcolsize.'">'."\n".
            '<div class="results">'."\n".
            '<div class="alert alert-info">'."\n".
            _t('BAZ_IL_Y_A').
            '<span class="nb-results">'.count($fiches['fiches']).'</span> '
            ._t('BAZ_FICHES_CORRESPONDANTES_FILTRES')."\n".
            '.</div>'."\n".
            $output."\n".
            '</div> <!-- /.results -->'."\n".
            '</div> <!-- /.col-xs-'.$resultcolsize.' -->';

        // colonne des filtres
        $outputfilter = '<div class="col-xs-'.$params['filtercolsize'].'">'."\n".'<div class="filters no-dblclick">'."\n";
        if ($params['filtertext'] == true) {
            $outputfilter .=
                        '<div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-filter"></i></span>
                            <input type="text" class="form-control filter-bazar" id="inputBazarFilter'
                            .$params['nbbazarliste'].'" placeholder="'._t('BAZAR_FILTER').'" data-target="bazar-list-'.$params['nbbazarliste'].'" />
                          </div>
                        </div>'."\n";
        }



        $i = 0;
        $first = true;


        if (is_array($formtab)) {
            // formulaire externe
            $allform = $formtab;
        } else {
            // on charge tous les formulaires
            $allform = baz_valeurs_formulaire();
        }

        // on recupere les facettes cochees
        $tabfacette = array();
        if (isset($_GET['facette']) && !empty($_GET['facette'])) {
            $tab = explode('|', $_GET['facette']);
            //découpe la requete autour des |
            foreach ($tab as $req) {
                $tabdecoup = explode('=', $req, 2);
                if (count($tabdecoup)>1) {
                    $tabfacette[$tabdecoup[0]] = explode(',', trim($tabdecoup[1]));
                }
            }
        }

        foreach ($params['groups'] as $id) {
            // on formatte la liste des resultats en fonction de la source
            if (isset($facettevalue[$id])) {
                if ($facettevalue[$id]['type'] == 'liste') {
                    $list = multiArraySearch($allform, 'id', $facettevalue[$id]['source']);
                    $list = $list[0];
                } elseif ($facettevalue[$id]['type'] == 'fiche') {
                    $src = str_replace(array('listefiche', 'checkboxfiche'), '', $facettevalue[$id]['source']);
                    $form = $allform[$src];
                    $list['titre_liste'] = $form['bn_label_nature'];
                    foreach ($facettevalue[$id] as $idfiche => $nb) {
                        if ($idfiche != 'source' && $idfiche != 'type') {
                            $f = baz_valeurs_fiche($idfiche);
                            $list['label'][$idfiche] = $f['bf_titre'];
                        }
                    }
                } elseif ($facettevalue[$id]['type'] == 'form') {
                    if ($facettevalue[$id]['source'] == 'id_typeannonce') {
                        $list['titre_liste'] = _t('BAZ_TYPE_FICHE');
                        foreach ($facettevalue[$id] as $idf => $nb) {
                            if ($idf != 'source' && $idf != 'type') {
                                $list['label'][$idf] = $allform[$idf]['bn_label_nature'];
                            }
                        }
                    } elseif ($facettevalue[$id]['source'] == 'createur') {
                        $list['titre_liste'] = _t('BAZ_CREATOR');
                        foreach ($facettevalue[$id] as $idf => $nb) {
                            if ($idf != 'source' && $idf != 'type') {
                                $list['label'][$idf] = $idf;
                            }
                        }
                    } else {
                        $list['titre_liste'] = $id;
                        foreach ($facettevalue[$id] as $idf => $nb) {
                            if ($idf != 'source' && $idf != 'type') {
                                $list['label'][$idf] = $idf;
                            }
                        }
                    }
                }
            }

            $idkey = htmlspecialchars($id);
            $outputfilter .=  '<div class="filter-box panel panel-default '.$idkey.'" data-id="'.$idkey.'">'."\n";
            $titlefilterbox = '';
            if (isset($params['groupicons'][$i]) && !empty($params['groupicons'][$i])) {
                $titlefilterbox .= '<i class="'.$params['groupicons'][$i].'"></i> ';
            }
            if (isset($params['titles'][$i]) && !empty($params['titles'][$i])) {
                $titlefilterbox .= $params['titles'][$i];
            } else {
                $titlefilterbox .= $list['titre_liste'];
            }
            $outputfilter .=  '<div class="panel-heading';
            if (!$first and $params['groupsexpanded'] == 'false') {
                $outputfilter .= ' collapsed';
            }
            $outputfilter .= '" data-toggle="collapse" href="#collapse'.$GLOBALS['_BAZAR_']['nbbazarliste'].'_'.$idkey.'" >'.
                $titlefilterbox.'</div>'."\n";
            $outputfilter .= '<div id="collapse'.$GLOBALS['_BAZAR_']['nbbazarliste'].'_'.$idkey.'" class="panel-collapse';
            if ($first or $params['groupsexpanded'] !== 'false') {
                $outputfilter .= ' in';
            }
            $outputfilter .= ' collapse">'."\n";
            $outputfilter .= '<div class="panel-body">'."\n";

            foreach ($list['label'] as $listkey => $label) {
                if (isset($facettevalue[$id][$listkey]) && !empty($facettevalue[$id][$listkey])) {
                    $outputfilter .=  '<div class="checkbox">
                    <label for="'.$idkey.$listkey.'">
                    <input class="filter-checkbox" type="checkbox" id="'.$idkey.$listkey.'" name="'.$idkey.'"
                    value="'.htmlspecialchars($listkey).'"'
                    .((isset($tabfacette[$idkey]) and in_array($listkey, $tabfacette[$idkey])) ? ' checked' : '').'>
                     '.$label.' (<span class="nb">'
                    .$facettevalue[$id][$listkey].'</span>)
                    </label></div>'."\n";
                }
            }

            $outputfilter .=  '</div></div></div><!-- /.filter-box -->'."\n";
            ++$i;
            $first = false;
        }
        $outputfilter .= '</div> <!-- /.filters -->'."\n".
            '</div> <!-- /.col-xs-3 -->'."\n";

        // disposition des filtres (gauche ou droite)
        if ($params['filterposition'] == 'right') {
            $outputfacette .= $outputresult.$outputfilter;
        } else {
            $outputfacette .= $outputfilter.$outputresult;
        }

        $output = $outputfacette.'</div><!-- /.facette-container.row -->';
    }
    // affiche les possibilités d'export
    if (!preg_match('/\/iframe/U', $_GET['wiki']) and $params['showexportbuttons']) {
        $key = '';
        if (isset($_GET['id']) and !empty($_GET['id'])) {
            $key = $_GET['id'];
        } elseif (is_array($GLOBALS['params']['idtypeannonce'])) {
            $key = implode(',',$GLOBALS['params']['idtypeannonce']);
        } elseif (!empty($GLOBALS['params']['idtypeannonce'])) {
            $key = $GLOBALS['params']['idtypeannonce'];
        } else {
            $keys =  array_keys($GLOBALS['_BAZAR_']['form']);
            $key = is_array($keys) ? implode(',', $keys) : $params['idtypeannonce'];
        }

        if (isset($_GET['q']) and !empty($_GET['q'])) {
            $key .= '&q='.$_GET['q'];
        }
        if (!empty($params['query'])) {
            $key .= '&query=';
            $first = true;
            $queryurl = '';
            foreach ($params['query'] as $id => $val) {
                if ($first) {
                    $first = false;
                } else {
                    $queryurl .= '|';
                }
                $queryurl .= $id.'='.$val;
            };
            $key.= $queryurl;
            // on sauve la valeur de query initiale pour des traitement javascripts
            $output .= '<input type="hidden" id="queryinit" value="'.htmlspecialchars($queryurl).'">'."\n";
        }
        if (!empty($key)) {
            $output .= '<div class="export-links pull-right"><a class="btn btn-default btn-mini btn-xs"
            data-toggle="tooltip" data-placement="bottom" title="'._t('BAZ_RSS').'"
            href="'.$GLOBALS['wiki']->href('rss', $GLOBALS['wiki']->getPageTag(), 'id='.$key).'">
            <i class="glyphicon glyphicon-signal icon-signal"></i></a>
            <a class="btn btn-default btn-mini btn-xs"
            data-toggle="tooltip" data-placement="bottom" title="'._t('BAZ_CSV').'"
            href="'.$GLOBALS['wiki']->href('', $GLOBALS['wiki']->getPageTag(), 'vue=exporter&id='.$key).'">
            CSV</a>
            <a class="btn btn-default btn-mini btn-xs"
            data-toggle="tooltip" data-placement="bottom" title="'._t('BAZ_JSON').'"
            href="'.$GLOBALS['wiki']->href('json', $GLOBALS['wiki']->getPageTag(), 'demand=entries&id='.$key).'">
            JSON</a>
            <a class="btn btn-default btn-mini btn-xs"
            data-toggle="tooltip" data-placement="bottom" title="'._t('BAZ_WIDGET').'"
            href="'.$GLOBALS['wiki']->href('widget', $GLOBALS['wiki']->getPageTag(), 'id='.$key).'">
            '._t('BAZ_WIDGET').'</a></div>';
        }
    }
    return $output;
}

function encoder_en_utf8($txt)
{

    // Nous remplacons l'apostrophe de type RIGHT SINGLE QUOTATION MARK et les & isoles qui n'auraient pas ete
    // remplaces par une entiteHTML.
    $cp1252_map = array("\xc2\x80" => "\xe2\x82\xac",

        /* EURO SIGN */
        "\xc2\x82" => "\xe2\x80\x9a",

        /* SINGLE LOW-9 QUOTATION MARK */
        "\xc2\x83" => "\xc6\x92",

        /* LATIN SMALL LETTER F WITH HOOK */
        "\xc2\x84" => "\xe2\x80\x9e",

        /* DOUBLE LOW-9 QUOTATION MARK */
        "\xc2\x85" => "\xe2\x80\xa6",

        /* HORIZONTAL ELLIPSIS */
        "\xc2\x86" => "\xe2\x80\xa0",

        /* DAGGER */
        "\xc2\x87" => "\xe2\x80\xa1",

        /* DOUBLE DAGGER */
        "\xc2\x88" => "\xcb\x86",

        /* MODIFIER LETTER CIRCUMFLEX ACCENT */
        "\xc2\x89" => "\xe2\x80\xb0",

        /* PER MILLE SIGN */
        "\xc2\x8a" => "\xc5\xa0",

        /* LATIN CAPITAL LETTER S WITH CARON */
        "\xc2\x8b" => "\xe2\x80\xb9",

        /* SINGLE LEFT-POINTING ANGLE QUOTATION */
        "\xc2\x8c" => "\xc5\x92",

        /* LATIN CAPITAL LIGATURE OE */
        "\xc2\x8e" => "\xc5\xbd",

        /* LATIN CAPITAL LETTER Z WITH CARON */
        "\xc2\x91" => "\xe2\x80\x98",

        /* LEFT SINGLE QUOTATION MARK */
        "\xc2\x92" => "\xe2\x80\x99",

        /* RIGHT SINGLE QUOTATION MARK */
        "\xc2\x93" => "\xe2\x80\x9c",

        /* LEFT DOUBLE QUOTATION MARK */
        "\xc2\x94" => "\xe2\x80\x9d",

        /* RIGHT DOUBLE QUOTATION MARK */
        "\xc2\x95" => "\xe2\x80\xa2",

        /* BULLET */
        "\xc2\x96" => "\xe2\x80\x93",

        /* EN DASH */
        "\xc2\x97" => "\xe2\x80\x94",

        /* EM DASH */
        "\xc2\x98" => "\xcb\x9c",

        /* SMALL TILDE */
        "\xc2\x99" => "\xe2\x84\xa2",

        /* TRADE MARK SIGN */
        "\xc2\x9a" => "\xc5\xa1",

        /* LATIN SMALL LETTER S WITH CARON */
        "\xc2\x9b" => "\xe2\x80\xba",

        /* SINGLE RIGHT-POINTING ANGLE QUOTATION*/
        "\xc2\x9c" => "\xc5\x93",

        /* LATIN SMALL LIGATURE OE */
        "\xc2\x9e" => "\xc5\xbe",

        /* LATIN SMALL LETTER Z WITH CARON */
        "\xc2\x9f" => "\xc5\xb8",

        /* LATIN CAPITAL LETTER Y WITH DIAERESIS*/
    );

    return strtr(preg_replace('/ \x{0026} /u', ' &#38; ', mb_convert_encoding($txt, 'UTF-8', 'HTML-ENTITIES')), $cp1252_map);
}

function sanitizeStringForRss($string) {
    $string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');
    return $string;
}

/** baz_affiche_flux_RSS() - affiche le flux rss a partir de parametres
 * @return string Le flux RSS, avec les headers et tout et tout
 */
function baz_afficher_flux_RSS()
{
    $urlrss = $GLOBALS['wiki']->href('rss');
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $urlrss .= '&amp;id='.$id;
    } else {
        $id = '';
    }

    if (isset($_GET['nbitem'])) {
        $nbitem = $_GET['nbitem'];
        $urlrss .= '&amp;nbitem='.$nbitem;
    } else {
        $nbitem = $GLOBALS['wiki']->config['BAZ_NB_ENTREES_FLUX_RSS'];
    }

    if (isset($_GET['utilisateur'])) {
        $utilisateur = $_GET['utilisateur'];
        $urlrss .= '&amp;utilisateur='.$utilisateur;
    } else {
        $utilisateur = '';
    }

    if (isset($_GET['statut'])) {
        $statut = $_GET['statut'];
        $urlrss .= '&amp;statut='.$statut;
    } else {
        $statut = 1;
    }

    // chaine de recherche
    $q = '';
    if (isset($_GET['q']) and !empty($_GET['q'])) {
        $q = $_GET['q'];
        $urlrss .= '&amp;q='.$q;
    }

    if (isset($_GET['query'])) {
        $query = $_GET['query'];
        $urlrss .= '&amp;query='.$query;
        $tabquery = array();
        $tableau = array();
        $tab = explode('|', $query); //découpe la requete autour des |
        foreach ($tab as $req) {
            $tabdecoup = explode('=', $req, 2);
            $tableau[$tabdecoup[0]] = trim($tabdecoup[1]);
        }
        $query = array_merge($tabquery, $tableau);
    } else {
        $query = '';
    }

    $tableau_flux_rss = baz_requete_recherche_fiches(
        $query,
        '',
        $id,
        '',
        $statut,
        $utilisateur,
        '',
        true,
        $q
    );
    $tableau_flux_rss = searchResultstoArray($tableau_flux_rss, array());
    $GLOBALS['ordre'] = 'desc';
    $GLOBALS['champ'] = 'date_creation_fiche';
    usort($tableau_flux_rss, 'champCompare');

    // Limite le nombre de résultat au nombre de fiches demandées
    $tableau_flux_rss = array_slice($tableau_flux_rss, 0, $nbitem);


    require_once BAZ_CHEMIN.'libs'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR
    .'XML/Util.php';

    // setlocale() pour avoir les formats de date valides (w3c) --julien
    setlocale(LC_TIME, 'C');

    $xml = XML_Util::getXMLDeclaration('1.0', 'UTF-8', 'yes');
    $xml .= "\r\n  ";
    $xml .= XML_Util::createStartElement('rss', array('version' => '2.0',
        'xmlns:atom' => 'http://www.w3.org/2005/Atom', 'xmlns:dc' => 'http://purl.org/dc/elements/1.1/', ));
    $xml .= "\r\n    ";
    $xml .= XML_Util::createStartElement('channel');
    $xml .= "\r\n      ";
    $xml .= XML_Util::createTag('title', null, sanitizeStringForRss(_t('BAZ_DERNIERE_ACTU')));
    $xml .= "\r\n      ";
    $xml .= XML_Util::createTag('link', null, sanitizeStringForRss($GLOBALS['wiki']->config['BAZ_RSS_ADRESSESITE'], ENT_QUOTES, 'UTF-8'));
    $xml .= "\r\n      ";
    $xml .= XML_Util::createTag('description', null, sanitizeStringForRss($GLOBALS['wiki']->config['BAZ_RSS_DESCRIPTIONSITE']));
    $xml .= "\r\n      ";
    $xml .= XML_Util::createTag('language', null, 'fr-FR');
    $xml .= "\r\n      ";
    $xml .= XML_Util::createTag('copyright', null, 'Copyright (c) '.date('Y').' '. sanitizeStringForRss($GLOBALS['wiki']->config['BAZ_RSS_NOMSITE']));
    $xml .= "\r\n      ";
    $xml .= XML_Util::createTag('lastBuildDate', null, gmstrftime('%a, %d %b %Y %H:%M:%S %Z'));
    $xml .= "\r\n      ";
    $xml .= XML_Util::createTag('docs', null, 'http://www.stervinou.com/projets/rss/');
    $xml .= "\r\n      ";
    $xml .= XML_Util::createTag('category', null, $GLOBALS['wiki']->config['BAZ_RSS_CATEGORIE']);
    $xml .= "\r\n      ";
    $xml .= XML_Util::createTag('managingEditor', null, $GLOBALS['wiki']->config['BAZ_RSS_MANAGINGEDITOR']);
    $xml .= "\r\n      ";
    $xml .= XML_Util::createTag('webMaster', null, $GLOBALS['wiki']->config['BAZ_RSS_WEBMASTER']);
    $xml .= "\r\n      ";
    $xml .= XML_Util::createTag('ttl', null, '60');
    $xml .= "\r\n      ";
    $xml .= XML_Util::createStartElement('image');
    $xml .= "\r\n        ";
    $xml .= XML_Util::createTag('title', null, sanitizeStringForRss(_t('BAZ_DERNIERE_ACTU')));
    $xml .= "\r\n        ";
    $xml .= XML_Util::createTag('url', null, $GLOBALS['wiki']->config['BAZ_RSS_LOGOSITE']);
    $xml .= "\r\n        ";
    $xml .= XML_Util::createTag('link', null, $GLOBALS['wiki']->config['BAZ_RSS_ADRESSESITE']);
    $xml .= "\r\n      ";
    $xml .= XML_Util::createEndElement('image');

    if (count($tableau_flux_rss) > 0) {
        // Creation des items : titre + lien + description + date de publication
        foreach ($tableau_flux_rss as $ligne) {
            $xml .= "\r\n      ";
            $xml .= XML_Util::createStartElement('item');
            $xml .= "\r\n        ";
            $xml .= XML_Util::createTag('title', null, str_replace('&', '&amp;', sanitizeStringForRss($ligne['bf_titre'])));
            $xml .= "\r\n        ";
            $xml .= XML_Util::createTag('link', null, '<![CDATA[' . $GLOBALS['wiki']->href('', $ligne['id_fiche']) . ']]>');
            $xml .= "\r\n        ";
            $xml .= XML_Util::createTag('guid', null, '<![CDATA[' . $GLOBALS['wiki']->href('', $ligne['id_fiche']) . ']]>');
            $xml .= "\r\n        ";
            $xml .= XML_Util::createTag('dc:creator', null, $ligne['createur']);
            $xml .= "\r\n      ";
            $xml .= XML_Util::createTag(
                'description',
                null,
                '<![CDATA['.preg_replace(
                    '/data-id=".*"/Ui',
                    '',
                    sanitizeStringForRss(baz_voir_fiche(0, $ligne))
                ).']]>'
            );
            $xml .= "\r\n        ";
            $xml .= XML_Util::createTag('pubDate', null, strftime('%a, %d %b %Y %H:%M:%S +0100', strtotime($ligne['date_creation_fiche'])));
            $xml .= "\r\n      ";
            $xml .= XML_Util::createEndElement('item');
        }
    } else {
        //pas d'annonces
        $xml .= "\r\n      ";
        $xml .= XML_Util::createStartElement('item');
        $xml .= "\r\n          ";
        $xml .= XML_Util::createTag('title', null, sanitizeStringForRss(_t('BAZ_PAS_DE_FICHES')));
        $xml .= "\r\n          ";
        $xml .= XML_Util::createTag('link', null, '<![CDATA['.$GLOBALS['wiki']->config['base_url'].$GLOBALS['wiki']->config['root_page'].']]>');
        $xml .= "\r\n          ";
        $xml .= XML_Util::createTag('guid', null, '<![CDATA['.$GLOBALS['wiki']->config['base_url'].$GLOBALS['wiki']->config['root_page'].']]>');
        $xml .= "\r\n          ";
        $xml .= XML_Util::createTag('description', null, sanitizeStringForRss(_t('BAZ_PAS_DE_FICHES')));
        $xml .= "\r\n          ";
        $xml .= XML_Util::createTag('pubDate', null, strftime('%a, %d %b %Y %H:%M:%S GMT', strtotime('01/01/%Y')));
        $xml .= "\r\n      ";
        $xml .= XML_Util::createEndElement('item');
    }
    $xml .= "\r\n    ";
    $xml .= XML_Util::createEndElement('channel');
    $xml .= "\r\n  ";
    $xml .= XML_Util::createEndElement('rss');

    echo str_replace(
        '</image>',
        '</image>'."\n"
        .'    <atom:link href="'. htmlentities((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])
        .'" rel="self" type="application/rss+xml" />',
        sanitizeStringForRss($xml, ENT_QUOTES, 'UTF-8')
    );
}

// pour verifier la presence d une valeur dans une fiche, en vue de lui faire une icone ou couleur personnalisee
function getCustomValueForEntry($parameter, $field, $entry, $default)
{
    if (is_array($parameter) && !empty($field)) {
        if (isset($entry[$field])) {
            // pour les checkbox, on teste les differentes valeurs et on renvoie la premiere qui va bien
            if (0 === strpos($field, 'checkbox')) {
                $tab = explode(',', $entry[$field]);
                foreach ($tab as $value) {
                    if (isset($parameter[$value])) {
                        // on retourne la premiere valeur trouvee
                        return $parameter[$value];
                    }
                }
                // on n a pas trouve de valeur, on renvoie la valeur par defaut
                return $default;
            } else {
                return isset($parameter[$entry[$field]]) ?
                    $parameter[$entry[$field]] : $default;
            }
        } else {
            // si la valeur n existe pas, on met l icone par defaut
            return $default;
        }
    } else {
        // si le parametre n'est pas un tableau, il contient la valeur par defaut
        return $default;
    }
}

// tri par ordre desire
function champCompare($a, $b)
{
    if ($GLOBALS['ordre'] == 'desc') {
        return strcoll($b[$GLOBALS['champ']], $a[$GLOBALS['champ']]);
    } else {
        return strcoll($a[$GLOBALS['champ']], $b[$GLOBALS['champ']]);
    }
}

// choix de la periode
function getDateMin($period)
{
    switch ($period) {
        case 'day':
            $d = strtotime("-1 day");
            return date("Y-m-d H:i:s", $d);
            break;
        case 'week':
            $d = strtotime("-1 week");
            return date("Y-m-d H:i:s", $d);
            break;
        case 'month':
            $d = strtotime("-1 month");
            return date("Y-m-d H:i:s", $d);
            break;
    }
}

/**
 * Construit un boolean à partir des valeurs "0","no","non","false" pour false,
 * sinon retourne true.
 * @param string $parameterName
 * @param boolean $default
 * @return boolean
 */
function getParameter_boolean($wiki, $parameterName, $default = true)
{
    $p = $wiki->GetParameter($parameterName);
    if (empty($p)) {
        $p = $default ;
    } elseif ($p == '0'
        || $p == 'no'
        || $p == 'non'
        || $p == 'false'
    ) {
        $p = false ;
    } else {
        $p = true ;
    }
    return $p ;
}

/** getAllParameters() - récupère tous les parametres possible pour une action de bazar
 * @return array tableau des parametres avec les valeurs par défaut
 */
function getAllParameters($wiki)
{
    $param = array();

    $param['action'] = $wiki->GetParameter(BAZ_VARIABLE_ACTION);
    if (isset($_GET[BAZ_VARIABLE_ACTION])) {
        $param['action'] = $_GET[BAZ_VARIABLE_ACTION];
    }

    $param['vue'] = $wiki->GetParameter(BAZ_VARIABLE_VOIR);
    if (isset($_GET[BAZ_VARIABLE_VOIR])) {
        $param['vue'] = $_GET[BAZ_VARIABLE_VOIR];
    }
    if (empty($param['vue'])) {
        // si rien n'est donne, on met la vue par defaut
        $param['vue'] = BAZ_VOIR_DEFAUT;
    }

    // afficher le menu de vues bazar ?
    $param['voirmenu'] = $wiki->GetParameter('voirmenu');
    if (empty($param['voirmenu']) && $param['voirmenu'] != '0') {
        $param['voirmenu'] = $GLOBALS['wiki']->config['baz_menu'];
    }

    // autoriser qu'une catégorie de formulaire
    $param['categorienature'] = $wiki->GetParameter('cat');
    if ($param['categorienature'] == 'toutes') {
        $param['categorienature'] = '';
    }
    // retrocompatibilite avec le parametre categorienature
    if (empty($param['categorienature'])) {
        $param['categorienature'] = $wiki->GetParameter('categorienature');
        if ($param['categorienature'] == 'toutes') {
            $param['categorienature'] = '';
        }
    }

    // identifiant du formulaire (plusieures valeurs possibles, séparées par des virgules)
    $param['idtypeannonce'] = $wiki->GetParameter('id');
    if (empty($param['idtypeannonce'])) {
        $param['idtypeannonce'] = isset($_GET['id']) ? $_GET['id'] : '';
    } else {
        $param['idtypeannonce'] = explode(',', $param['idtypeannonce']);
        $param['idtypeannonce'] = array_map('trim', $param['idtypeannonce']);
    }
    // retrocompatibilite avec le parametre idtypeannonce
    if (!is_array($param['idtypeannonce']) and empty($param['idtypeannonce'])) {
        // identifiant du formulaire (plusieures valuers possibles, séparées par des virgules)
        $param['idtypeannonce'] = $wiki->GetParameter('idtypeannonce');
        if (empty($param['idtypeannonce'])) {
            $param['idtypeannonce'] = '';
        } else {
            $param['idtypeannonce'] = explode(',', $param['idtypeannonce']);
            $param['idtypeannonce'] = array_map('trim', $param['idtypeannonce']);
        }
    }

    //on recupere les parameres pour une requete specifique
    if (isset($_GET['query'])) {
        $param['query'] = $wiki->GetParameter('query');
        if (!empty($param['query'])) {
            $param['query'] .= '|'.$_GET['query'];
        } else {
            $param['query'] = $_GET['query'];
        }
    } else {
        $param['query'] = $wiki->GetParameter('query');
    }
    if (!empty($param['query'])) {
        $tabquery = array();

        $tab = explode('|', $param['query']); //découpe la requete autour des |
        foreach ($tab as $req) {
            $tabdecoup = explode('=', $req, 2);
            if (isset($tabquery[$tabdecoup[0]]) && !empty($tabquery[$tabdecoup[0]])) {
                $tabquery[$tabdecoup[0]] = $tabquery[$tabdecoup[0]].','.trim($tabdecoup[1]);
            } else {
                $tabquery[$tabdecoup[0]] = trim($tabdecoup[1]);
            }
        }
    } else {
        $tabquery = '';
    }
    $param['query'] = $tabquery;

    // ordre du tri (asc ou desc)
    $param['ordre'] = $wiki->GetParameter('ordre');
    if (empty($param['ordre'])) {
        $param['ordre'] = 'asc';
    }

    // champ du formulaire utilisé pour le tri
    $param['champ'] = $wiki->GetParameter('champ');
    if (empty($param['champ'])) {
        $param['champ'] = 'bf_titre'; // si pas de champ précisé, on triera par le titre
    }

    // template utilisé pour l'affichage
    $param['template'] = isset($_GET['template']) ? $_GET['template'] : $wiki->GetParameter('template');
    if (empty($param['template']) ||
        (!is_file('themes/tools/bazar/templates/'.$param['template']) &&
            !is_file('tools/bazar/presentation/templates/'.
                $param['template']))) {
        $param['template'] = $GLOBALS['wiki']->config['default_bazar_template'];
    }

    // nombre maximal de résultats à afficher
    $param['nb'] = $wiki->GetParameter('nb');

    // classe css a ajouter en rendu des templates
    $param['class'] = $wiki->GetParameter('class');

    // ajout des options pour gerer la fiche (modifier, droits, etc,.. )
    $param['barregestion'] = getParameter_boolean($wiki, 'barregestion', true);

    // ajout des bouton pour gerer la fiche (modifier, droits, etc,.. )
    $param['showexportbuttons'] = getParameter_boolean($wiki, 'showexportbuttons', false);

    // possibilité d'avoir un ordre aléatoire des fiches
    $param['random'] = getParameter_boolean($wiki, 'random', false);

    // filtrer les resultats sur une periode données
    // si une date est indiquée
    $param['period'] = $wiki->GetParameter('period');
    if (isset($_GET['period']) && in_array($_GET['period'], array('day', 'week', 'month'))) {
        $param['datemin'] = getDateMin($_GET['period']);
    } elseif (!empty($param['period'])) {
        $param['datemin'] = getDateMin($param['period']);
    } else {
        $param['datemin'] = '';
    }

    // facette : identifiants servant de filtres
    //    plusieures valeurs possibles, séparées par des virgules,
    //    "all" pour toutes les facette possibles)
    //    exemple : {{bazarliste groups="bf_ce_titre,bf_ce_pays,etc."..}}
    $param['groups'] = isset($_GET['groups']) ? $_GET['groups'] : $wiki->GetParameter('groups');
    if (empty($param['groups'])) {
        $param['groups'] = array();
    } else {
        $param['groups'] = explode(',', $param['groups']);
        $param['groups'] = array_map('trim', $param['groups']);
    }

    // facette: titres des boite de filtres correspondants au parametre groups
    //    plusieures valeurs possibles, séparées par des virgules, le meme nombre que "groups"
    //    exemple : {{bazarliste titles="Titre,Pays,etc."..}}
    $param['titles'] = isset($_GET['titles']) ? $_GET['titles'] : $wiki->GetParameter('titles');
    if (empty($param['titles'])) {
        $param['titles'] = array();
    } else {
        $param['titles'] = explode(',', $param['titles']);
        $param['titles'] = array_map('trim', $param['titles']);
    }

    // facette: titres des boite de filtres correspondants au parametre groups
    //    plusieures valeurs possibles, séparées par des virgules, le meme nombre que "groups"
    //    exemple : {{bazarliste titles="Titre,Pays,etc."..}}
    $param['groupicons'] = $wiki->GetParameter('groupicons');
    if (empty($param['groupicons'])) {
        $param['groupicons'] = array();
    } else {
        $param['groupicons'] = explode(',', $param['groupicons']);
        $param['groupicons'] = array_map('trim', $param['groupicons']);
    }

    // nombre de résultats affichées avant pagination
    $param['pagination'] = $wiki->GetParameter('pagination');

    // ajout d'un filtre pour chercher du txte dans les resultats pour les facette
    $param['filtertext'] = getParameter_boolean($wiki, 'filtertext', false);

    // correspondance transfere les valeurs d'un champs vers un autre, afin de correspondre dans un template
    $param['correspondance'] = $wiki->GetParameter('correspondance');

    /*
     * Facette : filtres à gauche ou droite (droite par défaut)
     */
    $param['filterposition'] = isset($_GET['filterposition']) ? $_GET['filterposition'] : $wiki->GetParameter('filterposition');
    if (empty($param['filterposition']) || (!empty($param['filterposition'])
      && $param['filterposition'] != 'left')) {
        $param['filterposition'] = 'right';
    }

    /*
     * Facette : largeur colonne
     */
    $param['filtercolsize'] = isset($_GET['filtercolsize']) ? $_GET['filtercolsize'] : $wiki->GetParameter('filtercolsize');
    if (empty($param['filtercolsize'])
      || (!empty($param['filtercolsize'])
        && (!(ctype_digit($param['filtercolsize'])
          && intval($param['filtercolsize']) >= 1 && intval($param['filtercolsize']) <= 12)))) {
        $param['filtercolsize'] = '3';
    }

    /*
     * Facette: déplier tous les groupes (panels à droite)
     */
    $param['groupsexpanded'] = isset($_GET['groupsexpanded']) ? $_GET['groupsexpanded'] : $wiki->GetParameter('groupsexpanded');
    if (empty($param['groupsexpanded'])) {
        $param['groupsexpanded'] = 'true';
    }

    /*
     * Agenda : calendrier plus petit
     */
    $param['minical'] = $wiki->GetParameter('minical');

    /*
     * Permettre de rediriger vers une url apres saisie de fiche
     */
    $param['redirecturl'] = $wiki->GetParameter('redirecturl');

    // Parametres pour Bazarliste avec carto
    getAllParameters_carto($wiki, $param);

    return $param;
}

/**
 * Juste pour alléger la fonction getAllParameters(), regroupe les paramètres pour la cartographie.
 *
 * @param unknown $wiki
 * @param array $param
 */
function getAllParameters_carto($wiki, array &$param)
{

    /*
     * provider : designe le fond de carte utilisé pour la carte
     * cf. https://github.com/leaflet-extras/leaflet-providers
     */
    $param['provider'] = isset($_GET['provider']) ? $_GET['provider'] : $wiki->GetParameter('provider');
    if (empty($param['provider'])) {
        $param['provider'] = $GLOBALS['wiki']->config['baz_provider'];
    }
    // on recupere d eventuels id et token pour les providers en ayant besoin
    $param['providerid'] = $wiki->GetParameter('providerid');
    $param['providerpass'] = $wiki->GetParameter('providerpass');
    if (!empty($param['providerid']) && !empty($param['providerpass'])) {
        if ($param['provider'] == 'MapBox') {
            $param['provider_credentials'] = ', {id: \''.$param['providerid']
            .'\', accessToken: \''.$param['providerpass'].'\'}';
        } else {
            $param['provider_credentials'] = ', {
                app_id: \''.$param['providerid'].'\',
                app_code: \''.$param['providerpass'].'\'
            }';
        }
    } else {
        $param['provider_credentials'] = '';
    }

    /*
     * "providers" : une liste de fonds de carte.
     *
     * Exemple:
     * provider="OpenStreetMap.France" providers="OpenStreetMap.Mapnik,OpenStreetMap.France"
     *
     * TODO: ajouter gestion "providers_credentials"
     */
    $param['providers'] = $wiki->GetParameter('providers');
    if (!empty($param['providers'])) {
        $param['providers'] = explode(',', $param['providers']);
    }

    /*
     * "layers" : une liste de layers (couches).
     * Exemple avec 1 layer tiles, 1 layer geojson:
     * layers="BD Carthage|Tiles|//a.tile.openstreetmap.fr/route500hydro/{z}/{x}/{y}.png,CUCS 2014|GeoJson|wakka.php?wiki=geojsonCUCS2014/raw"
     * layers="BD Carthage|Tiles|//a.tile.openstreetmap.fr/route500hydro/{z}/{x}/{y}.png,CUCS 2014|GeoJson|color:'red';opacity:0.3|wakka.php?wiki=geojsonCUCS2014/raw"
     *
     * format pour chaque layer : NOM|TYPE|URL ou NOM|TYPE|OPTIONS|URL
     * - OPTIONS: facultatif ex: "color:red; opacity:0.3"
     * nota bene: le séparateur d'options est le ';' et pas la ',' qui est déjà utilisée pour séparer les LAYERS.
     * - TYPE: Tiles ou GeoJson
     * - URL: Attention au Blocage d’une requête multi-origines (Cross-Origin Request).
     *  Le plus simple est de recopier les data GeoJson dans une page du Wiki puis de l'appeler avec le handler "/raw".
     *
     * TODO: ajouter gestion "layers_credentials"
     */
    $param['layers'] = $wiki->GetParameter('layers');
    if (!empty($param['layers'])) {
        $param['layers'] = explode(',', $param['layers']);
    }

    /*
     * iconprefix : designe le prefixe des classes CSS utilisees pour la carto
     */
      $param['iconprefix'] = isset($_GET['iconprefix']) ? $_GET['iconprefix'] : $wiki->GetParameter('iconprefix');
    if (empty($param['iconprefix'])) {
        if (!empty($GLOBALS['wiki']->config['baz_marker_icon_prefix'])) {
            $param['iconprefix'] = $GLOBALS['wiki']->config['baz_marker_icon_prefix'];
        } else {
            $param['iconprefix'] = '';
        }
    } else {
        $param['iconprefix'] = trim($param['iconprefix']);
    }

    /*
     * iconfield : designe le champ utilise pour les icones des marqueurs
     */
    $param['iconfield'] = isset($_GET['iconfield']) ? $_GET['iconfield'] : $wiki->GetParameter('iconfield');

	/*
	 * icon : icone des marqueurs
	 */
	$param['icon'] = isset($_GET['icon']) ? $_GET['icon'] : $wiki->GetParameter('icon');
	if (!empty($param['icon'])) {
		$tabparam = array();
		$tabparam = getMultipleParameters($param['icon'], ',', '=');
		if ($tabparam['fail'] != 1){
			if (count($tabparam) > 1 && !empty($param['iconfield'])) {
				foreach ($tabparam as $key=>$data) {
					// on inverse cle et valeur, pour pouvoir les reprendre facilement dans la carto
					$tabparam[$data] = $key;
				 }
				 $param['icon'] = $tabparam;
			} else {
				$param['icon'] = trim($tabparam[0]);
				}
			} else {
				exit('<div class="alert alert-danger">action bazarliste : le paramètre icon est mal rempli.<br />Il doit être de la forme icon="nomIcone1=valeur1, nomIcone2=valeur2"</div>');
			}
		} else {
			$param['icon'] = $GLOBALS['wiki']->config['baz_marker_icon'];
		}
    /*
     * colorfield : designe le champ utilise pour la couleur des marqueurs
     */
    $param['colorfield'] = isset($_GET['colorfield']) ? $_GET['colorfield'] : $wiki->GetParameter('colorfield');

	/*
	* color : couleur des marqueurs
	*/
	$colors = array(
	    'red', 'darkred', 'lightred', 'orange', 'beige', 'green', 'darkgreen', 'lightgreen', 'blue', 'darkblue',
	    'lightblue', 'purple', 'darkpurple', 'pink', 'cadetblue', 'white', 'gray', 'lightgray', 'black',
	);
	$param['color'] = isset($_GET['color']) ? $_GET['color'] : $wiki->GetParameter('color');
	if (!empty($param['color'])) {
		$tabparam = array();
		$tabparam = getMultipleParameters($param['color'], ',', '=');
		if ($tabparam['fail'] != 1){
			if (count($tabparam) > 1 && !empty($param['colorfield'])) {
				foreach ($tabparam as $key=>$data) {
					 // on inverse cle et valeur, pour pouvoir les reprendre facilement dans la carto
					  $tabparam[$data] = $key;
				 }
				 $param['color'] = $tabparam;
			} else {
				 $param['color'] = trim($colors[0]);
				 if (!in_array($param['color'], $colors)) {
					  $param['color'] = $GLOBALS['wiki']->config['baz_marker_color'];
				 }
			}
		} else {
			exit('<div class="alert alert-danger">action bazarliste : le paramètre color est mal rempli.<br />Il doit être de la forme color="couleur1=valeur1, couleur2=valeur2"</div>');
		}
	} else {
		$param['color'] = $GLOBALS['wiki']->config['baz_marker_color'];
	}

    /*
     * smallmarker : mettre des puces petites ? non par defaut
     */
    $param['smallmarker'] = isset($_GET['smallmarker']) ? $_GET['smallmarker'] : $wiki->GetParameter('smallmarker');
    if (empty($param['smallmarker'])) {
        $param['markersize'] = isset($_GET['markersize']) ? $_GET['markersize'] : $wiki->GetParameter('markersize');
        if (!empty($param['markersize']) and $param['markersize'] == 'small') {
            $param['smallmarker'] = '1';
        } else {
            $param['smallmarker'] = $GLOBALS['wiki']->config['baz_small_marker'];
        }
    }
    if (!empty($param['smallmarker']) && $param['smallmarker'] == '1') {
        $param['smallmarker'] = '';
        $param['iconSize'] = '[15, 20]';
        $param['iconAnchor'] = '[8, 19]';
        $param['popupAnchor'] = '[0, -19]';
    } else {
        $param['smallmarker'] = ' xl';
        $param['iconSize'] = '[35, 46]';
        $param['iconAnchor'] = '[18, 45]';
        $param['popupAnchor'] = '[0, -45]';
    }

    /*
     * width : largeur de la carte à l'écran en pixels ou pourcentage
     */
    $param['width'] = isset($_GET['width']) ? $_GET['width'] : $wiki->GetParameter('width');
    if (empty($param['width'])) {
        $param['width'] = $GLOBALS['wiki']->config['baz_map_width'];
    }

    /*
     * height : hauteur de la carte à l'écran en pixels ou pourcentage
     */
    $param['height'] = isset($_GET['height']) ? $_GET['height'] : $wiki->GetParameter('height');
    if (empty($param['height'])) {
        $param['height'] = $GLOBALS['wiki']->config['baz_map_height'];
    }

    /*
     * lat : latitude point central en degres WGS84 (exemple : 46.22763) , sinon parametre par defaut
     */
    $param['latitude'] = isset($_GET['lat']) ? $_GET['lat'] : $wiki->GetParameter('lat');
    if (empty($param['latitude'])) {
        $param['latitude'] = $GLOBALS['wiki']->config['baz_map_center_lat'];
    }

    /*
     * lon : longitude point central en degres WGS84 (exemple : 3.42313) , sinon parametre par defaut
     */
    $param['longitude'] = isset($_GET['lon']) ? $_GET['lon'] : $wiki->GetParameter('lon');
    if (empty($param['longitude'])) {
        $param['longitude'] = $GLOBALS['wiki']->config['baz_map_center_lon'];
    }

    /*
     * niveau de zoom : de 1 (plus eloigne) a 15 (plus proche) , sinon parametre par defaut 5
     */
    $param['zoom'] = isset($_GET['zoom']) ? $_GET['zoom'] : $wiki->GetParameter('zoom');
    if (empty($param['zoom'])) {
        $param['zoom'] = $GLOBALS['wiki']->config['baz_map_zoom'];
    }

    /*
     * Outil de navigation , sinon parametre par defaut true
     */
    $param['navigation'] = isset($_GET['navigation']) ? $_GET['navigation'] : $wiki->GetParameter('navigation');
    if (empty($param['navigation'])) {
        $param['navigation'] = $GLOBALS['wiki']->config['baz_show_nav'];
    }

    /*
     * Zoom sur molette : true or false (defaut)
     */
    $param['zoom_molette'] = $wiki->GetParameter('zoommolette');
    if (empty($param['zoom_molette'])) {
        $param['zoom_molette'] = $GLOBALS['wiki']->config['baz_wheel_zoom'];
    }

    /*
     * Affichage en eclate des points superposes : true or false (defaut)
     */
    $param['spider'] = $wiki->GetParameter('spider'); // true or false
    if (empty($param['spider'])) {
        $param['spider'] = 'false';
    }

    /*
     * Affichage en cluster : true or false, par defaut false
     */
    $param['cluster'] = $wiki->GetParameter('cluster'); // true or false
    if (empty($param['cluster'])) {
        $param['cluster'] = 'false';
    }

    /*
     * Ajout bouton plein écran
     * fullscreen: true or false
     * https://github.com/brunob/leaflet.fullscreen
     */
    $param['fullscreen'] = $wiki->GetParameter('fullscreen');
    if (empty($param['fullscreen'])) {
        $param['fullscreen'] = 'true';
    }
}

function getMultipleParameters($param, $firstseparator = ',', $secondseparator = '=')
{
	// This function's aim is to fetch (key , value) couples stored in a multiple parameter
	// $param is the parameter where we have to fecth the couples
	// $firstseparator is the separator between the couples (usually ',')
	// $secondseparator is the separator between key and value in each couple (usually '=')
	// Returns the table of (key , value) couples
	// If fails to explode the data, then $tabparam['fail'] == 1
	$tabparam = array();
	$tabparam['fail'] = 0;
	// check if first and second separators are at least somewhere
	if (strpos($param, $secondseparator) !== false){
		$params = explode($firstseparator, $param);
		$params = array_map('trim', $params);
		if (count($params) > 0) {
            foreach ($params as $value) {
                if (!empty($value)) {
                    $tab = explode($secondseparator, $value);
                    $tab = array_map('trim', $tab);
                    if (count($tab) > 1) {
                        $tabparam[$tab[0]] = $tab[1];
                    } else {
                        $tabparam['fail'] = 1;
                    }
                }
			}
		} else {
            $tabparam['fail'] = 1;
		}
	} else {
        $tabparam['fail'] = 1;
	}
	return $tabparam;
}
