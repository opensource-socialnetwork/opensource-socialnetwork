<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$es = array(
		'ossnaddressbook:menu'               => 'Agenda de Contactos',
		'ossnaddressbook:title'              => 'Agenda de Contactos',
		'ossnaddressbook:subtitle:contacts'  => 'contactos',
		'ossnaddressbook:subtitle:favorites' => 'favoritos',
		'ossnaddressbook:search:placeholder' => 'Buscar contactos por nombre, teléfono, correo o empresa...',
		'ossnaddressbook:add'                => 'Añadir Contacto',
		'ossnaddressbook:add:toggle'         => 'Nuevo Contacto',
		'ossnaddressbook:name:placeholder'   => 'Nombre completo *',
		'ossnaddressbook:phone:placeholder'  => 'Teléfono / WhatsApp',
		'ossnaddressbook:email:placeholder'  => 'Correo electrónico',
		'ossnaddressbook:company:placeholder' => 'Empresa / Organización',
		'ossnaddressbook:address:placeholder' => 'Dirección / Ciudad',
		'ossnaddressbook:note:placeholder'   => 'Notas personales (opcional)...',
		'ossnaddressbook:category'           => 'Grupo',
		'ossnaddressbook:category:all'       => 'Todos',
		'ossnaddressbook:category:favorites' => 'Favoritos',
		'ossnaddressbook:category:personal'  => 'Personal',
		'ossnaddressbook:category:work'      => 'Trabajo',
		'ossnaddressbook:category:family'    => 'Familia',
		'ossnaddressbook:category:other'     => 'Otros',
		'ossnaddressbook:favorite'           => 'Favorito',
		'ossnaddressbook:edit'               => 'Editar',
		'ossnaddressbook:save'               => 'Guardar',
		'ossnaddressbook:cancel'             => 'Cancelar',
		'ossnaddressbook:delete'             => 'Eliminar',
		'ossnaddressbook:delete:all'         => 'Eliminar Todos',
		'ossnaddressbook:delete:all:confirm' => '¿Estás seguro de que quieres eliminar todos los contactos? Esta acción no se puede deshacer.',
		'ossnaddressbook:empty'              => 'Tu agenda está vacía. ¡Añade tu primer contacto arriba!',
		'ossnaddressbook:add:error'          => 'No se puede añadir el contacto. Por favor, introduce un nombre.',
		'ossnaddressbook:edit:error'         => 'No se puede actualizar el contacto.',
		'ossnaddressbook:delete:error'       => 'No se puede eliminar el contacto.',
		'ossnaddressbook:import'             => 'Importar',
		'ossnaddressbook:export:csv'         => 'Exportar CSV',
		'ossnaddressbook:export:vcf'         => 'Exportar vCard',
		'ossnaddressbook:import:success'     => '%s contactos importados correctamente.',
		'ossnaddressbook:import:error'       => 'Selecciona un archivo CSV o vCard (.vcf) para importar.',
		'ossnaddressbook:import:invalid'     => 'Formato de archivo no compatible. Solo se permiten archivos .csv y .vcf.',
		'ossnaddressbook:import:empty'       => 'No se encontraron contactos válidos en el archivo subido.',
);
ossn_register_languages('es', $es);
