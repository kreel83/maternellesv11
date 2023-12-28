<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Cahier
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $enfant_id
 * @property string $texte
 * @property int|null $section_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $definitif
 * @property string|null $send_at
 * @property string|null $ar_at
 * @method static \Illuminate\Database\Eloquent\Builder|Cahier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cahier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cahier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cahier whereArAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cahier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cahier whereDefinitif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cahier whereEnfantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cahier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cahier whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cahier whereSendAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cahier whereTexte($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cahier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cahier whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperCahier {}
}

namespace App\Models{
/**
 * App\Models\Categorie
 *
 * @property int $id
 * @property int $section_id
 * @property string $code
 * @property string|null $section1
 * @property string|null $section2
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie query()
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereSection1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereSection2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperCategorie {}
}

namespace App\Models{
/**
 * App\Models\Classe
 *
 * @property int $id
 * @property int $user_id Titulaire de la classe
 * @property string|null $description
 * @property int $ps Petite section
 * @property int $ms Moyenne section
 * @property int $gs Grande section
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $ecole_identifiant_de_l_etablissement
 * @property string|null $ecole_code_academie
 * @property string|null $groupes
 * @property string|null $equipes
 * @property int $periodes
 * @property string|null $direction
 * @property string $ordre_pdf
 * @property int $desactive_devenir_eleve
 * @property-read \App\Models\Ecole|null $ecole
 * @method static \Illuminate\Database\Eloquent\Builder|Classe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereDesactiveDevenirEleve($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereDirection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereEcoleCodeAcademie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereEcoleIdentifiantDeLEtablissement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereEquipes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereGroupes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereGs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereMs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereOrdrePdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe wherePeriodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe wherePs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperClasse {}
}

namespace App\Models{
/**
 * App\Models\ClasseUser
 *
 * @property int $id
 * @property int|null $classe_id
 * @property int|null $user_id
 * @property string|null $token
 * @property string|null $email
 * @property string|null $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseUser whereClasseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseUser whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseUser whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClasseUser whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperClasseUser {}
}

namespace App\Models{
/**
 * App\Models\Classification
 *
 * @property int $id
 * @property int $section_id
 * @property string $code
 * @property string $section1
 * @property string|null $section2
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Classification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereSection1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereSection2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperClassification {}
}

namespace App\Models{
/**
 * App\Models\Commentaire
 *
 * @property int $id
 * @property int $user_id
 * @property string $section_id
 * @property string $court
 * @property string|null $phrase_masculin
 * @property string|null $phrase_feminin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire query()
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire whereCourt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire wherePhraseFeminin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire wherePhraseMasculin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperCommentaire {}
}

namespace App\Models{
/**
 * App\Models\Configuration
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $equipes
 * @property string|null $groupes
 * @property int $periodes
 * @property string|null $direction
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int $periode
 * @property int $tuto
 * @property string $ordre_pdf
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration query()
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereDirection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereEquipes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereGroupes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereOrdrePdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration wherePeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration wherePeriodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereTuto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Configuration whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperConfiguration {}
}

namespace App\Models{
/**
 * App\Models\Contact
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $email
 * @property string|null $name
 * @property string $subject
 * @property string $message
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperContact {}
}

namespace App\Models{
/**
 * App\Models\Ecole
 *
 * @property int $id
 * @property string $identifiant_de_l_etablissement
 * @property string $nom_etablissement
 * @property string $type_etablissement
 * @property string $statut_public_prive
 * @property string $adresse_1
 * @property string $adresse_2
 * @property string $adresse_3
 * @property string $code_postal
 * @property string $code_commune
 * @property string $nom_commune
 * @property string $code_departement
 * @property string $code_academie
 * @property string $code_region
 * @property string $ecole_maternelle
 * @property string $ecole_elementaire
 * @property string $voie_generale
 * @property string $voie_technologique
 * @property string $voie_professionnelle
 * @property string $telephone
 * @property string $fax
 * @property string $web
 * @property string $mail
 * @property string $restauration
 * @property string $hebergement
 * @property string $ulis
 * @property string $apprentissage
 * @property string $segpa
 * @property string $section_arts
 * @property string $section_cinema
 * @property string $section_theatre
 * @property string $section_sport
 * @property string $section_internationale
 * @property string $section_europeenne
 * @property string $lycee_agricole
 * @property string $lycee_militaire
 * @property string $lycee_des_metiers
 * @property string $post_bac
 * @property string $appartenance_education_prioritaire
 * @property string $greta
 * @property string $siren_siret
 * @property string $nombre_d_eleves
 * @property string $fiche_onisep
 * @property string $position
 * @property string $type_contrat_prive
 * @property string $libelle_departement
 * @property string $libelle_academie
 * @property string $libelle_region
 * @property string $coordonnee_x
 * @property string $coordonnee_y
 * @property string $epsg
 * @property string $nom_circonscription
 * @property string $latitude
 * @property string $longitude
 * @property string $precision_localisation
 * @property string $date_ouverture
 * @property string $date_maj_ligne
 * @property string $etat
 * @property string $ministere_tutelle
 * @property string $etablissement_multi_lignes
 * @property string $rpi_concentre
 * @property string $rpi_disperse
 * @property string $code_nature
 * @property string $libelle_nature
 * @property string $code_type_contrat_prive
 * @property string $pial
 * @property string $etablissement_mere
 * @property string $type_rattachement_etablissement_mere
 * @property string $code_bassin_formation
 * @property string $libelle_bassin_formation
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereAdresse1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereAdresse2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereAdresse3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereAppartenanceEducationPrioritaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereApprentissage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereCodeAcademie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereCodeBassinFormation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereCodeCommune($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereCodeDepartement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereCodeNature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereCodePostal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereCodeRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereCodeTypeContratPrive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereCoordonneeX($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereCoordonneeY($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereDateMajLigne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereDateOuverture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereEcoleElementaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereEcoleMaternelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereEpsg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereEtablissementMere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereEtablissementMultiLignes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereEtat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereFicheOnisep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereGreta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereHebergement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereIdentifiantDeLEtablissement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereLibelleAcademie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereLibelleBassinFormation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereLibelleDepartement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereLibelleNature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereLibelleRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereLyceeAgricole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereLyceeDesMetiers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereLyceeMilitaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereMinistereTutelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereNomCirconscription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereNomCommune($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereNomEtablissement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereNombreDEleves($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole wherePial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole wherePostBac($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole wherePrecisionLocalisation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereRestauration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereRpiConcentre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereRpiDisperse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereSectionArts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereSectionCinema($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereSectionEuropeenne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereSectionInternationale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereSectionSport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereSectionTheatre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereSegpa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereSirenSiret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereStatutPublicPrive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereTypeContratPrive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereTypeEtablissement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereTypeRattachementEtablissementMere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereUlis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereVoieGenerale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereVoieProfessionnelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereVoieTechnologique($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ecole whereWeb($value)
 * @mixin \Eloquent
 */
	class IdeHelperEcole {}
}

namespace App\Models{
/**
 * App\Models\Enfant
 *
 * @property int $id
 * @property int|null $classe_id
 * @property string $nom
 * @property string $prenom
 * @property string $ddn
 * @property string|null $photo
 * @property string|null $mail
 * @property string|null $comment
 * @property int|null $groupe
 * @property string $token
 * @property string|null $mdp
 * @property string|null $datenotification
 * @property string|null $ecole
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $genre
 * @property int|null $user_id
 * @property int|null $annee_scolaire
 * @property int|null $user_n1_id
 * @property int|null $user_n2_id
 * @property string|null $background
 * @property int $sh
 * @property int $reussite_disabled
 * @property string|null $psmsgs
 * @property int $periode
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $item
 * @property-read int|null $item_count
 * @property-read \App\Models\User|null $user_rel
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereAnneeScolaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereBackground($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereClasseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereDatenotification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereDdn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereEcole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereGroupe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereMdp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant wherePeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant wherePsmsgs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereReussiteDisabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereSh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereUserN1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enfant whereUserN2Id($value)
 * @mixin \Eloquent
 */
	class IdeHelperEnfant {}
}

namespace App\Models{
/**
 * App\Models\Equipe
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $prenom
 * @property string|null $name
 * @property string|null $photo
 * @property string|null $fonction
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $mailcontact
 * @method static \Illuminate\Database\Eloquent\Builder|Equipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Equipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipe whereFonction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipe whereMailcontact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipe whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipe wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipe wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Equipe whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperEquipe {}
}

namespace App\Models{
/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $name
 * @property string|null $comment
 * @property string $date
 * @property string $rep
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereRep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperEvent {}
}

namespace App\Models{
/**
 * App\Models\Facture
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $transaction_id
 * @property int $number
 * @property string $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Facture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facture query()
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperFacture {}
}

namespace App\Models{
/**
 * App\Models\FactureLigne
 *
 * @property int $id
 * @property int|null $facture_id
 * @property int|null $produit_id
 * @property int $quantity
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FactureLigne newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FactureLigne newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FactureLigne query()
 * @method static \Illuminate\Database\Eloquent\Builder|FactureLigne whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FactureLigne whereFactureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FactureLigne whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FactureLigne wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FactureLigne whereProduitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FactureLigne whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FactureLigne whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperFactureLigne {}
}

namespace App\Models{
/**
 * App\Models\Fiche
 *
 * @property int $id
 * @property int|null $item_id
 * @property int|null $classe_id
 * @property int|null $order
 * @property int|null $perso
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property int|null $section_id
 * @property string|null $parent_type
 * @property-read \App\Models\Item|null $item
 * @method static \Illuminate\Database\Eloquent\Builder|Fiche newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fiche newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fiche query()
 * @method static \Illuminate\Database\Eloquent\Builder|Fiche whereClasseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fiche whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fiche whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fiche whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fiche whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fiche whereParentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fiche wherePerso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fiche whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fiche whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fiche whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperFiche {}
}

namespace App\Models{
/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $name
 * @property string $keywords
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereName($value)
 * @mixin \Eloquent
 */
	class IdeHelperImage {}
}

namespace App\Models{
/**
 * App\Models\Item
 *
 * @property int $id
 * @property int $section_id
 * @property int|null $categorie_id
 * @property int|null $user_id
 * @property int|null $image_id
 * @property int|null $classification_id
 * @property string $name
 * @property string|null $image_nom
 * @property string|null $activite
 * @property string|null $lvl
 * @property string|null $st
 * @property string|null $status
 * @property string|null $phrase_masculin
 * @property string|null $phrase_feminin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Categorie|null $categorie
 * @property-read \App\Models\Image|null $image
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereActivite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCategorieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereClassificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereImageNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereLvl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePhraseFeminin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePhraseMasculin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperItem {}
}

namespace App\Models{
/**
 * App\Models\Licence
 *
 * @property int $id
 * @property int|null $parent_id id du propriétaire de la soucription (directeur)
 * @property int|null $user_id
 * @property int|null $produit_id Dernier produit ID pour la licence. Permet de savoir si elle est à renouveler par rapport au produit en cours
 * @property int $actif
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Licence newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Licence newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Licence query()
 * @method static \Illuminate\Database\Eloquent\Builder|Licence whereActif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Licence whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Licence whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Licence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Licence whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Licence whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Licence whereProduitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Licence whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Licence whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperLicence {}
}

namespace App\Models{
/**
 * App\Models\Myperiode
 *
 * @property int $id
 * @property int $user_id
 * @property int $annee
 * @property int $periode
 * @property string $date_start
 * @property string $date_end
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|Myperiode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Myperiode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Myperiode query()
 * @method static \Illuminate\Database\Eloquent\Builder|Myperiode whereAnnee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Myperiode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Myperiode whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Myperiode whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Myperiode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Myperiode wherePeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Myperiode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Myperiode whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperMyperiode {}
}

namespace App\Models{
/**
 * App\Models\Notation
 *
 * @property int $id
 * @property string $nom
 * @property string $color
 * @property int $user_id
 * @property int $level
 * @method static \Illuminate\Database\Eloquent\Builder|Notation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notation whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notation whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notation whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notation whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperNotation {}
}

namespace App\Models{
/**
 * App\Models\Personnel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel query()
 * @mixin \Eloquent
 */
	class IdeHelperPersonnel {}
}

namespace App\Models{
/**
 * App\Models\Phrase
 *
 * @property int $id
 * @property int $commentaire_id
 * @property int $enfant_id
 * @property int $order
 * @property int $section_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Phrase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phrase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phrase query()
 * @method static \Illuminate\Database\Eloquent\Builder|Phrase whereCommentaireId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phrase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phrase whereEnfantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phrase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phrase whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phrase whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phrase whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperPhrase {}
}

namespace App\Models{
/**
 * App\Models\Produit
 *
 * @property int $id
 * @property string|null $stripe_product_id
 * @property string|null $reference
 * @property string|null $name
 * @property string $price
 * @property string|null $active_from
 * @property string|null $active_to
 * @property string|null $available_from
 * @property string|null $available_to
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Produit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Produit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Produit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Produit whereActiveFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produit whereActiveTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produit whereAvailableFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produit whereAvailableTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produit wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produit whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produit whereStripeProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produit whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperProduit {}
}

namespace App\Models{
/**
 * App\Models\Resultat
 *
 * @property int $id
 * @property int $item_id
 * @property int $enfant_id
 * @property int|null $section_id
 * @property int|null $user_id
 * @property int $notation
 * @property string $groupe
 * @property int|null $autonome
 * @property int|null $periode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Resultat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resultat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resultat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Resultat whereAutonome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resultat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resultat whereEnfantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resultat whereGroupe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resultat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resultat whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resultat whereNotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resultat wherePeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resultat whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resultat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resultat whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperResultat {}
}

namespace App\Models{
/**
 * App\Models\Reussite
 *
 * @property int $id
 * @property int|null $enfant_id
 * @property int|null $user_id
 * @property string|null $texte_integral
 * @property string|null $commentaire_general
 * @property int|null $definitif
 * @property int|null $periode
 * @property string|null $send_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite whereCommentaireGeneral($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite whereDefinitif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite whereEnfantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite wherePeriode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite whereSendAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite whereTexteIntegral($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reussite withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperReussite {}
}

namespace App\Models{
/**
 * App\Models\ReussiteSection
 *
 * @property int $id
 * @property int $reussite_id
 * @property int $section_id
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ReussiteSection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReussiteSection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReussiteSection query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReussiteSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReussiteSection whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReussiteSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReussiteSection whereReussiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReussiteSection whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReussiteSection whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperReussiteSection {}
}

namespace App\Models{
/**
 * App\Models\Section
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @property string $image_section
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $logo
 * @property string $court
 * @property string $texte
 * @property string|null $icone
 * @property int|null $ordre
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Commentaire> $commentaires
 * @property-read int|null $commentaires_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Item> $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|Section newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section query()
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereCourt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereIcone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereImageSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereOrdre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereTexte($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperSection {}
}

namespace App\Models{
/**
 * App\Models\Subscription
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $stripe_id
 * @property string $stripe_status
 * @property string|null $stripe_price
 * @property int|null $quantity
 * @property string|null $trial_ends_at
 * @property string|null $ends_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereStripePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereStripeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperSubscription {}
}

namespace App\Models{
/**
 * App\Models\Template
 *
 * @property int $id
 * @property string $nom
 * @property int $user_id
 * @property string $items_liste
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|Template newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template query()
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereItemsListe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperTemplate {}
}

namespace App\Models{
/**
 * App\Models\Texte
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Texte newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Texte newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Texte query()
 * @mixin \Eloquent
 */
	class IdeHelperTexte {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $user_id User à l'origine de la transaction
 * @property int|null $produit_id
 * @property int|null $subscription_id
 * @property string|null $txid Numéro de transaction
 * @property string|null $method
 * @property float|null $price
 * @property int|null $quantity
 * @property float|null $amount
 * @property string|null $customer Stripe Customer ID
 * @property string|null $status Stripe Status
 * @property string|null $payment_method
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereProduitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereSubscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTxid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUserId($value)
 * @mixin \Eloquent
 */
	class IdeHelperTransaction {}
}

namespace App\Models{
/**
 * App\Models\TransactionLicence
 *
 * @property int $id
 * @property int|null $transaction_id
 * @property int|null $licence_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLicence newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLicence newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLicence query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLicence whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLicence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLicence whereLicenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLicence whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionLicence whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperTransactionLicence {}
}

namespace App\Models{
/**
 * App\Models\Tuto
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Tuto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tuto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tuto query()
 * @mixin \Eloquent
 */
	class IdeHelperTuto {}
}

namespace App\Models{
/**
 * App\Models\Tutoriel
 *
 * @property int $id
 * @property string $page
 * @property string $champ
 * @property int $etape
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string $texte
 * @property string|null $action
 * @property string $titre
 * @method static \Illuminate\Database\Eloquent\Builder|Tutoriel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tutoriel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tutoriel query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tutoriel whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutoriel whereChamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutoriel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutoriel whereEtape($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutoriel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutoriel wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutoriel whereTexte($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutoriel whereTitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tutoriel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperTutoriel {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property int|null $classe_id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $confirmation_token
 * @property string|null $prenom
 * @property string|null $mobile
 * @property string|null $classe
 * @property string|null $sectionColors
 * @property string|null $ecole_identifiant_de_l_etablissement
 * @property string|null $nom_ecole
 * @property string|null $directeur_nom
 * @property string $directeur_prenom
 * @property string|null $adresse_ecole
 * @property string|null $academie
 * @property string|null $repertoire
 * @property string $signature
 * @property string $directeur_civilite
 * @property string|null $photo
 * @property string|null $reject
 * @property int|null $comment
 * @property string|null $expire_le
 * @property string|null $datePayment
 * @property int|null $actif
 * @property string|null $periodes
 * @property string|null $mailcontact
 * @property string|null $sections
 * @property string|null $stripe_id
 * @property string|null $pm_type
 * @property string|null $pm_last_four
 * @property string|null $trial_ends_at
 * @property string $role
 * @property string|null $licence
 * @property string|null $validation_key
 * @property string|null $civilite
 * @property string $phone
 * @property-read \App\Models\Configuration|null $configuration
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notation> $notations
 * @property-read int|null $notations_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Cashier\Subscription> $subscriptions
 * @property-read int|null $subscriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User hasExpiredGenericTrial()
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onGenericTrial()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAcademie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAdresseEcole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCivilite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereClasse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereClasseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereConfirmationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDatePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDirecteurCivilite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDirecteurNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDirecteurPrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEcoleIdentifiantDeLEtablissement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereExpireLe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLicence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMailcontact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNomEcole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePeriodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePmLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePmType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereReject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRepertoire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSectionColors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSections($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereValidationKey($value)
 * @mixin \Eloquent
 */
	class IdeHelperUser {}
}

namespace App\Models{
/**
 * App\Models\Vacance
 *
 * @property int $id
 * @property string|null $ecole_code_academie
 * @property string|null $description
 * @property string|null $population
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $location
 * @property string|null $zones
 * @property string|null $annee_scolaire
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Vacance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vacance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vacance query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vacance whereAnneeScolaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacance whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacance whereEcoleCodeAcademie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacance whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacance whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacance wherePopulation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacance whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacance whereZones($value)
 * @mixin \Eloquent
 */
	class IdeHelperVacance {}
}

