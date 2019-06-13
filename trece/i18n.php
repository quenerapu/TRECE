<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php

/*
Usage:

  "hello_world" => [ # Please use always UNDERSCORE instead HYPHEN or DASH. CamelCase is ok too. :)
    "es"  => "Hola mundo",
    "gal" => "Ola mundo",
    "en"  => "Hello world",
    ];

  echo $lCommon["hello_world"][PAGE_LANGUAGE];
  echo $lCommon["hello_world"]["gal"];

or...

  "greetings" => [
    "hello_world" => [
      "es"  => "Hola mundo.",
      "gal" => "Ola mundo.",
      "en"  => "Hello world.",
      ],
    "good_bye_world" => [
      "es"  => "Adiós mundo.",
      "gal" => "Adeus mundo.",
      "en"  => "Good bye world.",
      ],
    ];

  echo $lCommon["greetings"]["hello_world"][PAGE_LANGUAGE];
  echo $lCommon["greetings"]["hello_world"]["gal"];

or...

  "greetings" => [
    "welcome" => [
      "f" => [
        "es"  => "Bienvenida.",
        "gal" => "Benvida.",
        "en"  => "Welcome.",
        ],
      "m" => [
        "es"  => "Bienvenido.",
        "gal" => "Benvido.",
        "en"  => "Welcome.",
        ],
      ],
    ];

  echo $lCommon["greetings"]["welcome"][USER_GENDER][PAGE_LANGUAGE];
  echo $lCommon["greetings"]["welcome"]["f"]["gal"];

or...

  "greetings" => [
    "welcome" => [
      "es"  => "Bienvenid%s.",
      "gal" => "Benvid%s.",
      ],
    ];

  echo sprintf($lCommon["greetings"]["welcome"][PAGE_LANGUAGE],"a");
  echo sprintf($lCommon["greetings"]["welcome"]["gal"],"a");

*/



# -----------------------------------------------------------------------------------



return [

# ...............................................................................................................
# .....###.......................................................................................................
# ....##.##......................................................................................................
# ...##...##.....................................................................................................
# ..##.....##....................................................................................................
# ..#########....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ...............................................................................................................

  "about" => [
    "es"  => "Acerca de %s",
    "gal" => "Sobre %s",
    "en"  => "All about %s",
    ],
  "about_us" => [
    "es"  => "Acerca de nosotros",
    "gal" => "Sobre nós",
    "en"  => "About us",
    ],
  "accreditations" => [
    "es" => "Acreditaciones",
    "gal" => "Acreditacións",
    "en" => "Accreditations",
    ],
  "accept" => [
    "es" => "Aceptar",
    "gal" => "Aceptar",
    "en" => "Accept",
    ],
  "actions" => [
    "es" => "Acciones",
    "gal" => "Accións",
    "en" => "Actions",
    ],
  "active" => [
    "es" => "Activo",
    "gal" => "Activo",
    "en" => "Active",
    ],
  "activity" => [
    "es"  => "Actividad",
    "gal" => "Actividade",
    "en"  => "Activity",
    ],
  "activities" => [
    "es"  => "Actividades",
    "gal" => "Actividades",
    "en"  => "Activities",
    ],
  "activity_list_admin" => [
    "es"  => "Administración de actividades",
    "gal" => "Administración de actividades",
    "en"  => "Activity list",
    ],
  "actual_page" => [
    "es" => "Página actual",
    "gal" => "Páxina actual",
    "en" => "Actual page",
    ],
  "add" => [
    "es"  => "Anadir",
    "gal" => "Engadir",
    "en"  => "Add",
    ],
  "add_site" => [
    "es"  => "Anadir sede",
    "gal" => "Engadir sede",
    "en"  => "Add site",
    ],
  "address" => [
    "es"  => "Dirección",
    "gal" => "Enderezo",
    "en"  => "Address",
    ],
  "admin" => [
    "es"  => "Administración",
    "gal" => "Administración",
    "en"  => "Admin",
    ],
  "admin_list" => [
    "es"  => "Listado del administrador/a",
    "gal" => "Listado do administrador/a",
    "en"  => "Admin list",
    ],
  "and_add_a_new_blank_file" => [
    "es"  => "...y crear una nueva ficha en blanco",
    "gal" => "...e crear unha nova ficha en branco",
    "en"  => "...and ad a new blank file",
    ],
  "answers" => [
    "es"  => "Posibles respuestas",
    "gal" => "Posibles respostas",
    "en"  => "Available answers",
    ],
  "are_you_sure" => [
    "es"  => "¿Estás seguro/a?",
    "gal" => "Estás seguro/a?",
    "en"  => "Are you sure?",
    ],
  "area" => [
    "es"  => "Área",
    "gal" => "Área",
    "en"  => "Area",
    ],
  "areas" => [
    "es"  => "Áreas",
    "gal" => "Áreas",
    "en"  => "Areas",
    ],
  "areas_list_admin" => [
    "es"  => "Administración de áreas",
    "gal" => "Administración de áreas",
    "en"  => "Areas list",
    ],
  "asoc" => [
    "es"  => "Asociación",
    "gal" => "Asociación",
    "en"  => "Associantion",
    ],
  "asocs" => [
    "es"  => "Asociaciones",
    "gal" => "Asociacións",
    "en"  => "Associantions",
    ],
  "asocs_list_admin" => [
    "es"  => "Administración de asociaciones",
    "gal" => "Administración de asociacións",
    "en"  => "Associations list",
    ],
  "avatar" => [
    "es"  => "Avatar",
    "gal" => "Avatar",
    "en"  => "Avatar",
    ],



# ...............................................................................................................
# ..########.....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..########.....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..########.....................................................................................................
# ...............................................................................................................

  "blog" => [
    "es"  => "Blog",
    "gal" => "Blog",
    "en"  => "Blog",
    ],
  "bloglabels" => [
    "es"  => "Etiquetas del blog",
    "gal" => "Etiquetas do blog",
    "en"  => "Blog labels",
    ],
  "board" => [
    "es"  => "Junta Directiva",
    "gal" => "Xunta Directiva",
    "en"  => "Board of Directors",
    ],



# ...............................................................................................................
# ...######......................................................................................................
# ..##....##.....................................................................................................
# ..##...........................................................................................................
# ..##...........................................................................................................
# ..##...........................................................................................................
# ..##....##.....................................................................................................
# ...######......................................................................................................
# ...............................................................................................................

  "change-password" => [
    "es"  => "Cambiar contraseña",
    "gal" => "Mudar de contrasinal",
    "en"  => "Change password",
    ],
  "cancel" => [
    "es"  => "Cancelar",
    "gal" => "Cancelar",
    "en"  => "Cancel",
    ],
  "cannot_be_added" => [
    "es"  => "No se puede añadir",
    "gal" => "Non se pode engadir",
    "en"  => "Cannot be added",
    ],
  "cannot_be_cloned" => [
    "es"  => "No se puede clonar",
    "gal" => "Non se pode clonar",
    "en"  => "Cannot be cloned",
    ],
  "cannot_be_deleted" => [
    "es"  => "No se puede borrar",
    "gal" => "Non se pode borrar",
    "en"  => "Cannot be deleted",
    ],
  "cannot_be_labeled" => [
    "es"  => "No se puede etiquetar",
    "gal" => "Non se pode etiquetar",
    "en"  => "Cannot be labeled",
    ],
  "clic_here_to_change_your_password" => [
    "es"  => "Haz clic aquí para crear/cambiar tu contraseña para %s:",
    "gal" => "Fai clic aquí para crear/cambiar o teu contrasinal para %s:",
    "en"  => "Do click here to create/change your password for %s:",
    ],
  "clone" => [
    "es"  => "Clonar",
    "gal" => "Clonar",
    "en"  => "Clone",
    ],
  "clone_activity" => [
    "es"  => "Clonar actividad",
    "gal" => "Clonar actividade",
    "en"  => "Clone activity",
    ],
  "clone_area" => [
    "es"  => "Clonar área",
    "gal" => "Clonar área",
    "en"  => "Clone area",
    ],
  "clone_asoc" => [
    "es"  => "Clonar asociación",
    "gal" => "Clonar asociación",
    "en"  => "Clone association",
    ],
  "clone_course" => [
    "es"  => "Clonar curso",
    "gal" => "Clonar curso",
    "en"  => "Clone course",
    ],
  "clone_edition" => [
    "es"  => "Clonar edición",
    "gal" => "Clonar edición",
    "en"  => "Clone edition",
    ],
  "clone_file" => [
    "es"  => "Clonar archivo",
    "gal" => "Clonar arquivo",
    "en"  => "Clone file",
    ],
  "clone_filetype" => [
    "es"  => "Clonar tipo de archivo",
    "gal" => "Clonar tipo de arquivo",
    "en"  => "Clone filetype",
    ],
  "clone_folder" => [
    "es"  => "Clonar carpeta",
    "gal" => "Clonar cartafol",
    "en"  => "Clone folder",
    ],
  "clone_highlight_zone" => [
    "es"  => "Clonar zona destacada",
    "gal" => "Clonar zona destacada",
    "en"  => "Clone highlight zone",
    ],
  "clone_post" => [
    "es"  => "Clonar publicación",
    "gal" => "Clonar publicación",
    "en"  => "Clone post",
    ],
  "clone_site" => [
    "es"  => "Clonar sede",
    "gal" => "Clonar sede",
    "en"  => "Clone site",
    ],
  "clone_subject" => [
    "es"  => "Clonar tema",
    "gal" => "Clonar tema",
    "en"  => "Clone subject",
    ],
  "closed" => [
    "es"  => "Cerrado",
    "gal" => "Pechado",
    "en"  => "Closed",
    ],
  "code" => [
    "es"  => "Código",
    "gal" => "Código",
    "en"  => "Code",
    ],
  "coordinates" => [
    "es"  => "Coordenadas",
    "gal" => "Coordenadas",
    "en"  => "Coordinates",
    ],
  "confirm" => [
    "es"  => "Confirmar",
    "gal" => "Confirmar",
    "en"  => "Confirm",
    ],
  "contact" => [
    "es"  => "Contacto",
    "gal" => "Contacto",
    "en"  => "Contact",
    ],
  "copy" => [
    "es"  => "Copia",
    "gal" => "Copia",
    "en"  => "Copy",
    ],
  "counties" => [
    "es"  => "Comarcas",
    "gal" => "Comarcas",
    "en"  => "Counties",
    ],
  "countries" => [
    "es"  => "Países",
    "gal" => "Países",
    "en"  => "Countries",
    ],
  "courses" => [
    "es"  => "Cursos",
    "gal" => "Cursos",
    "en"  => "Courses",
    ],
  "courses_list_admin" => [
    "es"  => "Administración de cursos",
    "gal" => "Administración de cursos",
    "en"  => "Course list",
    ],
  "create_account" => [
    "es"  => "Crear cuenta",
    "gal" => "Crear conta",
    "en"  => "Create account",
    ],



# ...............................................................................................................
# ..########.....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..########.....................................................................................................
# ...............................................................................................................

  "date" => [
    "es" => "Fecha",
    "gal" => "Data",
    "en" => "Date",
    ],
  "days" => [
    "es" => ["Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo"],
    "gal" => ["Luns","Martes","Mércores","Xoves","Venres","Sábado","Domingo"],
    "en" => ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
    ],
  "debug_url_on_facebook" => [
    "es"  => "Depurar URL en Facebook",
    "gal" => "Depurar URL no Facebook",
    "en"  => "Debug URL on Facebook",
  ],
  "demo" => [
    "es"  => "Demo",
    "gal" => "Demo",
    "en"  => "Demo",
  ],
  "delete" => [
    "es" => "Borrar",
    "gal" => "Borrar",
    "en" => "Delete",
    ],
  "description" => [
    "es" => "Descripción",
    "gal" => "Descripción",
    "en" => "Description",
    ],
  "download" => [
    "es" => "Descargar",
    "gal" => "Descargar",
    "en" => "Download",
    ],
  "duplicated_title" => [
    "es" => "Título repetido.",
    "gal" => "Título repetido.",
    "en" => "Duplicated title.",
    ],



# ...............................................................................................................
# ..########.....................................................................................................
# ..##...........................................................................................................
# ..##...........................................................................................................
# ..######.......................................................................................................
# ..##...........................................................................................................
# ..##...........................................................................................................
# ..########.....................................................................................................
# ...............................................................................................................

  "edit" => [
    "es"  => "Editar",
    "gal" => "Editar",
    "en"  => "Edit",
    ],
  "edit_activity" => [
    "es"  => "Editar actividad",
    "gal" => "Editar actividade",
    "en"  => "Edit activity",
    ],
  "edit_area" => [
    "es"  => "Editar área",
    "gal" => "Editar área",
    "en"  => "Edit area",
    ],
  "edit_asoc" => [
    "es"  => "Editar asociación",
    "gal" => "Editar asociación",
    "en"  => "Edit association",
    ],
  "edit_course" => [
    "es"  => "Editar curso",
    "gal" => "Editar curso",
    "en"  => "Edit course",
    ],
  "edit_edition" => [
    "es"  => "Editar edición",
    "gal" => "Editar edición",
    "en"  => "Edit edition",
    ],
  "edit_event" => [
    "es"  => "Editar evento",
    "gal" => "Editar evento",
    "en"  => "Edit event",
    ],
  "edit_file" => [
    "es"  => "Editar archivo",
    "gal" => "Editar arquivo",
    "en"  => "Edit file",
    ],
  "edit_filetype" => [
    "es"  => "Editar tipo de archivo",
    "gal" => "Editar tipo de arquivo",
    "en"  => "Edit filetype",
    ],
  "edit_folder" => [
    "es"  => "Editar carpeta",
    "gal" => "Editar cartafol",
    "en"  => "Edit folder",
    ],
  "edit_highlight_zone" => [
    "es"  => "Editar zona destacada",
    "gal" => "Editar zona destacada",
    "en"  => "Edit highlight zone",
    ],
  "edit_instructor" => [
    "es"  => "Editar ponente",
    "gal" => "Editar relator/a",
    "en"  => "Edit instructor",
    ],
  "edit_post" => [
    "es"  => "Editar publicación",
    "gal" => "Editar publicación",
    "en"  => "Edit post",
    ],
  "edit-profile" => [
    "es"  => "Editar perfil",
    "gal" => "Editar perfil",
    "en"  => "Edit profile",
    ],
  "edit_question" => [
    "es"  => "Editar consulta",
    "gal" => "Editar consulta",
    "en"  => "Edit question",
    ],
  "edit_site" => [
    "es"  => "Editar sede",
    "gal" => "Editar sede",
    "en"  => "Edit site",
    ],
  "edit_subject" => [
    "es"  => "Editar tema",
    "gal" => "Editar tema",
    "en"  => "Edit subject",
    ],
  "edition" => [
    "es"  => "Edición",
    "gal" => "Edición",
    "en"  => "Edition",
    ],
  "editions" => [
    "es"  => "Ediciones",
    "gal" => "Edicións",
    "en"  => "Editions",
    ],
  "edition_list_admin" => [
    "es"  => "Administración de ediciones",
    "gal" => "Administración de edicións",
    "en"  => "Edition list",
    ],
  "email" => [
    "es"  => "Correo electrónico",
    "gal" => "Correo electrónico",
    "en"  => "eMail address",
    ],
  "email_already_in_use" => [
    "es"  => "Este correo electrónico ya está en uso",
    "gal" => "Este correo electrónico xa está en uso",
    "en"  => "eMail address already in use",
    ],
  "email_or_username" => [
    "es"  => "Correo electrónico o nombre de usuario/a",
    "gal" => "Correo electrónico ou nome de usuario/a",
    "en"  => "eMail address or username",
    ],
  "end_time" => [
    "es"  => "Hora de finalización",
    "gal" => "Hora de remate",
    "en"  => "End time",
    ],
  "event" => [
    "es"  => "Evento",
    "gal" => "Evento",
    "en"  => "Event",
    ],
  "events" => [
    "es"  => "Eventos",
    "gal" => "Eventos",
    "en"  => "Events",
    ],
  "event_list_admin" => [
    "es"  => "Administración de eventos",
    "gal" => "Administración de eventos",
    "en"  => "Event list",
    ],
  "extension" => [
    "es"  => "Extensión",
    "gal" => "Extensión",
    "en"  => "Extension",
    ],



# ...............................................................................................................
# ..########.....................................................................................................
# ..##...........................................................................................................
# ..##...........................................................................................................
# ..######.......................................................................................................
# ..##...........................................................................................................
# ..##...........................................................................................................
# ..##...........................................................................................................
# ...............................................................................................................

  "few_data" => [
    "es"  => "No hay datos para mostrar en esta página",
    "gal" => "Non hai datos para amosar nesta páxina",
    "en"  => "No data to show in this page",
    ],
  "file" => [
    "es"  => "Archivo",
    "gal" => "Arquivo",
    "en"  => "File",
    ],
  "files" => [
    "es"  => "Archivos",
    "gal" => "Arquivos",
    "en"  => "Files",
    ],
  "filetype" => [
    "es"  => "Tipo de archivo",
    "gal" => "Tipo de arquivo",
    "en"  => "Filetype",
    ],
  "filetypes" => [
    "es"  => "Tipos de archivo",
    "gal" => "Tipos de arquivo",
    "en"  => "Filetypes",
    ],
  "files_list_admin" => [
    "es"  => "Lista de archivos",
    "gal" => "Lista de arquivos",
    "en"  => "File list",
    ],
  "filetypes_list_admin" => [
    "es"  => "Lista de tipos de archivo",
    "gal" => "Lista de tipos de arquivo",
    "en"  => "Filetype list",
    ],
  "first_page" => [
    "es"  => "Primera página",
    "gal" => "Primeira páxina",
    "en"  => "First page",
    ],
  "folder" => [
    "es"  => "Carpeta",
    "gal" => "Cartafol",
    "en"  => "Folder",
    ],
  "folders" => [
    "es"  => "Carpetas",
    "gal" => "Cartafois",
    "en"  => "Folders",
    ],
  "folders_list_admin" => [
    "es"  => "Listado de carpetas",
    "gal" => "Listado de cartafois",
    "en"  => "Folders list",
    ],
  "forgot-password" => [
    "es"  => "Olvidé o desconozco mi contraseña",
    "gal" => "Esquecín ou descoñezo o meu contrasinal",
    "en"  => "Forgot or don't know my password",
    ],
  "free_field" => [
    "es"  => "Campo libre",
    "gal" => "Campo libre",
    "en"  => "Free field",
    ],



# ...............................................................................................................
# ...######......................................................................................................
# ..##....##.....................................................................................................
# ..##...........................................................................................................
# ..##...####....................................................................................................
# ..##....##.....................................................................................................
# ..##....##.....................................................................................................
# ...######......................................................................................................
# ...............................................................................................................

  "gdpr" => [
    "accept" => [
      "es"  => "Aceptar",
      "gal" => "Aceptar",
      "en"  => "Accept",
      ],
    "cookie_policy" => [
      "es"  => "Política de <em>cookies</em>",
      "gal" => "Política de <em>cookies</em>",
      "en"  => "Cookie policy",
      ],
    "more_info" => [
      "es"  => "Más información",
      "gal" => "Máis información",
      "en"  => "More information",
      ],
    "privacy_policy" => [
      "es"  => "Política de privacidad",
      "gal" => "Política de privacidade",
      "en"  => "Privacy policy",
      ],
    "txt" => [ # https://www.40defiebre.com/que-es/experiencia-usuario
      "es"  => "Utilizamos <em>cookies</em> propias y de terceros para mejorar tu experiencia como usuario/a y la seguridad.",
      "gal" => "Utilizamos <em>cookies</em> propias e de terceiros para mellorar a túa experiencia como usuario/a e a seguridade.",
      "en"  => "We use our own cookies and those of third parties to improve your browsing experience and security.",
      ],
    ],
  "gender" => [
    "es"  => "Género",
    "gal" => "Xénero",
    "en"  => "Gender",
    ],
  "genders" => [
    "es"  => "Géneros",
    "gal" => "Xéneros",
    "en"  => "Genders",
    ],
  "general_error" => [
    "es"  => "Error",
    "gal" => "Erro",
    "en"  => "Error",
    ],
  "general_ok" => [
    "es"  => "Ok",
    "gal" => "Ok",
    "en"  => "Ok",
    ],
  "generate_new_password" => [
    "es"  => "Generar nueva contraseña",
    "gal" => "Xener novo contrasinal",
    "en"  => "Generate new password",
    ],
  "google_maps" => [
    "es"  => "Google Maps",
    "gal" => "Google Maps",
    "en"  => "Google Maps",
    ],



# ...............................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..#########....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ...............................................................................................................

  "hello" => [
    "es"  => "Hola",
    "gal" => "Ola",
    "en"  => "Hello",
    ],
  "hello_world" => [
    "es"  => "Hola mundo",
    "gal" => "Ola mundo",
    "en"  => "Hello world",
    ],
  "hidden" => [
    "es"  => "Oculto",
    "gal" => "Oculto",
    "en"  => "Hidden",
    ],
  "hierarchy" => [
    "es"  => "Jerarquía",
    "gal" => "Xerarquía",
    "en"  => "Hierarchy",
    ],
  "highlight_zones_list_admin" => [
    "es"  => "Administración de zonas destacadas",
    "gal" => "Administración de zonas destacadas",
    "en"  => "Highlight zone list",
    ],
  "highlight_zones" => [
    "es"  => "zonas destacadas",
    "gal" => "zonas destacadas",
    "en"  => "Highlight zones",
    ],
  "highlighted" => [
    "es"  => "Destacado",
    "gal" => "Destacado",
    "en"  => "Highlighted",
    ],
  "hint" => [
    "es"  => "Sugerencia",
    "gal" => "Suxestión",
    "en"  => "Hint",
    ],
  "hours" => [
    "es"  => "Horas",
    "gal" => "Horas",
    "en"  => "Hours",
    ],
  "how_many_do_you_want" => [
    "es"  => "¿Cuántos? (Máx. %s)",
    "gal" => "Cantos/as? (Máx. %s)",
    "en"  => "How many? (Max. %s)",
    ],



# ...............................................................................................................
# ..####.........................................................................................................
# ...##..........................................................................................................
# ...##..........................................................................................................
# ...##..........................................................................................................
# ...##..........................................................................................................
# ...##..........................................................................................................
# ..####.........................................................................................................
# ...............................................................................................................

  "icon" => [
    "es" => "Icono",
    "gal" => "Icona",
    "en" => "Icon",
    ],
  "image" => [
    "es" => "Imagen",
    "gal" => "Imaxe",
    "en" => "Image",
    ],
  "inactive" => [
    "es" => "Inactivo",
    "gal" => "Inactivo",
    "en" => "Inactive",
    ],
  "info" => [
    "es" => "Info",
    "gal" => "Info",
    "en" => "Info",
    ],
  "insecure_password" => [
    "es" => "Contraseña insegura",
    "gal" => "Contrasinal inseguro",
    "en" => "Insecure password",
    ],
  "instructor" => [
    "es" => "Ponente",
    "gal" => "Relator/a",
    "en" => "Instructor",
    ],
  "instructors" => [
    "es" => "Ponentes",
    "gal" => "Relatores/as",
    "en" => "Instructors",
    ],
  "instructor_list_admin" => [
    "es"  => "Administración de ponentes",
    "gal" => "Administración de relatores/as",
    "en"  => "Instructor list",
    ],
  "it_must_be_unique" => [
    "es" => "Tiene que ser un valor único.",
    "gal" => "Ten que ser un valor único.",
    "en" => "It must be an unique value.",
    ],



# ...............................................................................................................
# ........##.....................................................................................................
# ........##.....................................................................................................
# ........##.....................................................................................................
# ........##.....................................................................................................
# ..##....##.....................................................................................................
# ..##....##.....................................................................................................
# ...######......................................................................................................
# ...............................................................................................................



# ...............................................................................................................
# ..##....##.....................................................................................................
# ..##...##......................................................................................................
# ..##..##.......................................................................................................
# ..#####........................................................................................................
# ..##..##.......................................................................................................
# ..##...##......................................................................................................
# ..##....##.....................................................................................................
# ...............................................................................................................



# ...............................................................................................................
# ..##...........................................................................................................
# ..##...........................................................................................................
# ..##...........................................................................................................
# ..##...........................................................................................................
# ..##...........................................................................................................
# ..##...........................................................................................................
# ..########.....................................................................................................
# ...............................................................................................................

  "labels" => [
    "es"  => "Etiquetas",
    "gal" => "Etiquetas",
    "en"  => "Labels",
    ],
  "landscape" => [
    "es"  => "Horizontal",
    "gal" => "Horizontal",
    "en"  => "Landscape",
    ],
  "language" => [
    "es"  => "Idioma",
    "gal" => "Idioma",
    "en"  => "Language",
    ],
  "languages" => [
    "es"  => "Idiomas",
    "gal" => "Idiomas",
    "en"  => "Languages",
    ],
  "last_page" => [
    "es"  => "Última página",
    "gal" => "Última páxina",
    "en"  => "Last page",
    ],
  "latitude" => [
    "es"  => "Latitud",
    "gal" => "Latitude",
    "en"  => "Latitude",
    ],
  "lead_in" => [
    "es"  => "Entradilla",
    "gal" => "Entradiña",
    "en"  => "Lead in",
    ],
  "letter" => [
    "es"  => "Letra",
    "gal" => "Letra",
    "en"  => "Letter",
    ],
  "list" => [
    "es"  => "Listado",
    "gal" => "Listado",
    "en"  => "List",
    ],
  "locations" => [
    "es"  => "Localidades",
    "gal" => "Concellos",
    "en"  => "Locations",
    ],
  "logo" => [
    "es"  => "Logo",
    "gal" => "Logo",
    "en"  => "Logo",
    ],
  "longitude" => [
    "es"  => "Longitud",
    "gal" => "Lonxitude",
    "en"  => "Longitude",
    ],



# ...............................................................................................................
# ..##.....##....................................................................................................
# ..###...###....................................................................................................
# ..####.####....................................................................................................
# ..##.###.##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ...............................................................................................................

  "me" => [
    "es"  => "Sobre mi",
    "gal" => "Sobre min",
    "en"  => "About me",
    ],
  "message_sent" => [
    "es"  => "Mensaje enviado",
    "gal" => "Mensaxe enviada",
    "en"  => "Message sent",
    ],
  "messages" => [
    "es"  => [
      "forgot-password" => [
        "title" => "Tu contraseña",
        "body" => "Hola, %s.<br><br>Haz clic en el siguiente enlace para crear/cambiar tu contraseña para %s:<br>%s<br><br>Gracias.",
        ],
      "change-password" => [
        "title" => "Tu nueva contraseña",
        "body" => "Hola, %s.<br><br>Cambiaste exitosamente tu contraseña para %s.<br><br>Ya puedes iniciar tu sesión en<br>%s<br><br>Gracias.",
        ],
      ],

    "gal"  => [
      "forgot-password" => [
        "title" => "O teu contrasinal",
        "body" => "Ola, %s.<br><br>Fai clic na seguinte ligazón para crear/cambiar o teu contrasinal para %s:<br>%s<br><br>Grazas.",
        ],
      "change-password" => [
        "title" => "O teu novo contrasinal",
        "body" => "Ola, %s.<br><br>Mudaches exitosamente o teu contrasinal para %s.<br><br>Xa podes iniciar a tua sesión en<br>%s<br><br>Grazas.",
        ],
      ],

    "en"  => [
      "forgot-password" => [
        "title" => "Your password",
        "body" => "Hello, %s.<br><br>Do click on the following link to create/change your password for %s:<br>%s<br><br>Thank you.",
        ],
      "change-password" => [
        "title" => "Your new password",
        "body" => "Hello, %s.<br><br>You've successfully changed your password for %s:<br><br>You can now sign in at<br>%s<br><br>Thank you.",
        ],
      ],
    ],
  "module" => [
    "es"  => "Módulo",
    "gal" => "Módulo",
    "en"  => "Module",
    ],
  "multiple_delete" => [
    "es"  => "Borrado múltiple",
    "gal" => "Borrado múltiple",
    "en"  => "Multiple delete",
    ],
  "multiple_label" => [
    "es"  => "Etiquetado múltiple",
    "gal" => "Etiquetado múltiple",
    "en"  => "Multiple label",
    ],



# ...............................................................................................................
# ..##....##.....................................................................................................
# ..###...##.....................................................................................................
# ..####..##.....................................................................................................
# ..##.##.##.....................................................................................................
# ..##..####.....................................................................................................
# ..##...###.....................................................................................................
# ..##....##.....................................................................................................
# ...............................................................................................................

  "name" => [
    "es"  => "Nombre",
    "gal" => "Nome",
    "en"  => "Name",
    ],
  "new_activity" => [
    "es"  => "Nueva actividad",
    "gal" => "Nova actividade",
    "en"  => "New activity",
    ],
  "new_area" => [
    "es"  => "Nueva área",
    "gal" => "Nova área",
    "en"  => "New area",
    ],
  "new_asoc" => [
    "es"  => "Nueva asociación",
    "gal" => "Nova asociación",
    "en"  => "New association",
    ],
  "new_blog_post" => [
    "es"  => "Nueva publicación en el blog",
    "gal" => "Nova publicación no blog",
    "en"  => "New blog post",
    ],
  "new_course" => [
    "es"  => "Nuevo curso",
    "gal" => "Novo curso",
    "en"  => "New course",
    ],
  "new_edition" => [
    "es"  => "Nueva edición",
    "gal" => "Nova edición",
    "en"  => "New edition",
    ],
  "new_file" => [
    "es"  => "Nuevo archivo",
    "gal" => "Novo arquivo",
    "en"  => "New file",
    ],
  "new_filetype" => [
    "es"  => "Nuevo tipo de archivo",
    "gal" => "Novo tipo de arquivo",
    "en"  => "New filetype",
    ],
  "new_folder" => [
    "es"  => "Nueva carpeta",
    "gal" => "Novo cartafol",
    "en"  => "New folder",
    ],
  "new_highlight_zone" => [
    "es"  => "Nueva zona destacada",
    "gal" => "Nova zona destacada",
    "en"  => "New highlight zone",
    ],
  "new_instructor" => [
    "es"  => "Nuevo ponente",
    "gal" => "Novo relator/a",
    "en"  => "New instructor",
    ],
  "new_question" => [
    "es"  => "Nueva consulta",
    "gal" => "Nova consulta",
    "en"  => "New question",
    ],
  "new_site" => [
    "es"  => "Nueva sede",
    "gal" => "Nova sede",
    "en"  => "New site",
    ],
  "new_subject" => [
    "es"  => "Nuevo tema",
    "gal" => "Novo tema",
    "en"  => "New subject",
    ],
  "next" => [
    "es"  => "Siguiente",
    "gal" => "Seguinte",
    "en"  => "Next",
    ],
  "no" => [
    "es"  => "No",
    "gal" => "Non",
    "en"  => "No",
    ],
  "none" => [
    "es"  => "Ninguno",
    "gal" => "Ningún",
    "en"  => "None",
    ],
  "no_data" => [
    "es"  => "No hay datos para mostrar",
    "gal" => "Non hai datos para amosar",
    "en"  => "No data to show",
    ],
  "not_corresponding_email_address_or_username" => [
    "es"  => "Correo electrónico o nombre de usuario/a no correspondiente con esta petición de cambio de contraseña.",
    "gal" => "Correo electrónico ou nome de usuario/a non correspondente con esta petición de cambio de contrasinal.",
    "en"  => "eMail address or username not corresponding with this password change request.",
    ],
  "not_highlighted" => [
    "es"  => "No destacado",
    "gal" => "Non destacado",
    "en"  => "Not highlighted",
    ],
  "not_published" => [
    "es"  => "No publicado",
    "gal" => "Non publicado",
    "en"  => "Not published",
    ],
  "not_visible" => [
    "es"  => "No visible",
    "gal" => "Non visible",
    "en"  => "Not visible",
    ],



# ...............................................................................................................
# ...#######.....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ...#######.....................................................................................................
# ...............................................................................................................

  "objetives" => [
    "es"  => "Objetivos",
    "gal" => "Obxectivos",
    "en"  => "Objetives",
    ],
  "open" => [
    "es"  => "Abierto",
    "gal" => "Aberto",
    "en"  => "Open",
    ],
  "options" => [
    "es"  => "Opciones",
    "gal" => "Opcións",
    "en"  => "Options",
    ],
  "order" => [
    "es"  => "Orden",
    "gal" => "Orde",
    "en"  => "Order",
    ],



# ...............................................................................................................
# ..########.....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..########.....................................................................................................
# ..##...........................................................................................................
# ..##...........................................................................................................
# ..##...........................................................................................................
# ...............................................................................................................

  "page" => [
    "es"  => "Página",
    "gal" => "Páxina",
    "en"  => "Page",
    ],
  "parent" => [
    "es"  => "Padre",
    "gal" => "Pai",
    "en"  => "Parent",
    ],
  "password" => [
    "es"  => "Contraseña",
    "gal" => "Contrasinal",
    "en"  => "Password",
    ],
  "password_must_match" => [
    "es"  => "La contraseña tiene que coincidir",
    "gal" => "O contrasinal ten que coincidir",
    "en"  => "Password must match",
    ],
  "password_successfully_changed" => [
    "es"  => "La contraseña fue cambiada con éxito.",
    "gal" => "O contrasinal foi cambiado con éxito.",
    "en"  => "Password successfully changed.",
    ],
  "password_tip" => [
    "es"  => "Mínimo 8 caracteres y al menos una mayúscula, una minúscula, un número y un signo. %s genera contraseñas de calidad y %s muestra/oculta el texto de la contraseña. Cuando la barra se pone de color verde indica que tienes una buena contraseña y puedes continuar.",
    "gal" => "Mínimo 8 caracteres e alomenos unha maiúscula, unha minúscula, un número e un signo. %s xera contrasinais de calidade e %s amosa/oculta o texto do contrasinal. Cando a barra se pon de cor verde, indica que tes un bo contrasinal e podes continuar.",
    "en"  => "Minimum 8 characters and at least one uppercase, one lowercase, one number and one sign. %s generates quality passwords and %s shows/hides the password text.",
    ],
  "phones" => [
    "es"  => "Números de teléfono",
    "gal" => "Números de teléfono",
    "en"  => "Phone numbers",
    ],
  "places" => [
    "es"  => "Lugares",
    "gal" => "Lugares",
    "en"  => "Places",
    ],
  "please_select" => [
    "es"  => "Por favor, elige",
    "gal" => "Por favor, elixe",
    "en"  => "Please select",
    ],
  "post" => [
    "es"  => "Publicación",
    "gal" => "Publicación",
    "en"  => "Post",
    ],
  "posts" => [
    "es"  => "Publicaciones",
    "gal" => "Publicacións",
    "en"  => "Posts",
    ],
  "poster" => [
    "es"  => "Cartel",
    "gal" => "Cartaz",
    "en"  => "Poster",
    ],
  "posts_list_admin" => [
    "es"  => "Publicaciones del blog",
    "gal" => "Publicacións do blog",
    "en"  => "Blog posts",
    ],
  "previous" => [
    "es"  => "Anterior",
    "gal" => "Anterior",
    "en"  => "Previous",
    ],
  "private_list" => [
    "es"  => "Listado privado",
    "gal" => "Listado privado",
    "en"  => "Private list",
    ],
  "privileges" => [
    "es"  => "Privilegios",
    "gal" => "Privilexios",
    "en"  => "Privileges",
    ],
  "profile" => [
    "es"  => "Perfil",
    "gal" => "Perfil",
    "en"  => "Profile",
    ],
  "provinces" => [
    "es"  => "Provincias",
    "gal" => "Provincias",
    "en"  => "Provinces",
    ],
  "public_list" => [
    "es"  => "Listado público",
    "gal" => "Listado público",
    "en"  => "Public list",
    ],
  "published" => [
    "es"  => "Publicado",
    "gal" => "Publicado",
    "en"  => "Published",
    ],



# ...............................................................................................................
# ...#######.....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##..##.##....................................................................................................
# ..##....##.....................................................................................................
# ...#####.##....................................................................................................
# ...............................................................................................................

  "question" => [
    "es"  => "Consulta",
    "gal" => "Consulta",
    "en"  => "Question",
    ],
  "questions" => [
    "es"  => "Consultas",
    "gal" => "Consultas",
    "en"  => "Questions",
    ],
  "questions_list_admin" => [
    "es"  => "Administración de consultas",
    "gal" => "Administración de consultas",
    "en"  => "Questions list",
    ],



# ...............................................................................................................
# ..########.....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..########.....................................................................................................
# ..##...##......................................................................................................
# ..##....##.....................................................................................................
# ..##.....##....................................................................................................
# ...............................................................................................................

  "regions" => [
    "es"  => "Regiones",
    "gal" => "Rexións",
    "en"  => "Regions",
    ],
  "replace" => [
    "es"  => "Sustituir",
    "gal" => "Substituir",
    "en"  => "Replace",
    ],
  "repeat_here" => [
    "es"  => "Repite aquí",
    "gal" => "Repite aquí",
    "en"  => "Repeat here",
    ],
  "reset_search" => [
    "es"  => "Resetear la búsqueda",
    "gal" => "Resetea-la busca",
    "en"  => "Reset search",
    ],
  "result" => [
    "es"  => "resultado",
    "gal" => "resultado",
    "en"  => "result",
    ],
  "results" => [
    "es"  => "resultados",
    "gal" => "resultados",
    "en"  => "results",
    ],



# ...............................................................................................................
# ...######......................................................................................................
# ..##....##.....................................................................................................
# ..##...........................................................................................................
# ...######......................................................................................................
# ........##.....................................................................................................
# ..##....##.....................................................................................................
# ...######......................................................................................................
# ...............................................................................................................

  "save_changes" => [
    "es"  => "Guardar cambios",
    "gal" => "Gardar cambios",
    "en"  => "Save changes",
    ],
  "search" => [
    "es"  => "Buscar",
    "gal" => "Buscar",
    "en"  => "Search",
    ],
  "see" => [
    "es"  => "Ver",
    "gal" => "Ollar",
    "en"  => "See",
    ],
  "see_public_post" => [
    "es"  => "Ver la publicación",
    "gal" => "Ollar a publicación",
    "en"  => "See the post",
    ],
  "see_public_profile" => [
    "es"  => "Ver el perfil público",
    "gal" => "Ollar o perfil público",
    "en"  => "See the public profile",
    ],
  "send_email" => [
    "es"  => "Enviar eMail",
    "gal" => "Enviar eMail",
    "en"  => "Send eMail",
    ],
  "send_form" => [
    "es"  => "Enviar formulario",
    "gal" => "Enviar formulario",
    "en"  => "Send form",
    ],
  "send_message" => [
    "es"  => "Enviar mensaje",
    "gal" => "Enviar mensaxe",
    "en"  => "Send eMail",
    ],
  "send_reminder" => [
    "es"  => "Enviar recordatorio",
    "gal" => "Enviar recordatorio",
    "en"  => "Send reminder",
    ],
  "share_on" => [
    "es"  => "Compartir en",
    "gal" => "Compartir en",
    "en"  => "Share on",
    ],
  "share_by" => [
    "es"  => "Compartir vía",
    "gal" => "Compartir vía",
    "en"  => "Share by",
    ],
  "short_description" => [
    "es"  => "Descripción breve",
    "gal" => "Descripción breve",
    "en"  => "Short description",
    ],
  "short_name" => [
    "es"  => "Nombre breve",
    "gal" => "Nome breve",
    "en"  => "Short name",
    ],
  "signin" => [
    "es"  => "Iniciar sesión",
    "gal" => "Iniciar sesión",
    "en"  => "Sign in",
    ],
  "signin_fail" => [
    "es"  => "Error en el inicio de sesión. Correo electrónico, nombre de usuario/a o contraseña incorrectos.",
    "gal" => "Erro no inicio de sesión. Correo electrónico, nome de usuario/a ou contrasinal incorrectos.",
    "en"  => "Sign in fail. Wrong eMail address, username or password.",
    ],
  "signout" => [
    "es"  => "Cerrar sesión",
    "gal" => "Pechar sesión",
    "en"  => "Sign out",
    ],
  "site" => [
    "es"  => "Sede",
    "gal" => "Sede",
    "en"  => "Site",
    ],
  "sites" => [
    "es"  => "Sedes",
    "gal" => "Sedes",
    "en"  => "Sites",
    ],
  "site_list_admin" => [
    "es"  => "Administración de sedes",
    "gal" => "Administración de sedes",
    "en"  => "Site list",
    ],
  "start_time" => [
    "es"  => "Hora de inicio",
    "gal" => "Hora de inicio",
    "en"  => "Start time",
    ],
  "subject" => [
    "es"  => "Tema",
    "gal" => "Tema",
    "en"  => "Subject",
    ],
  "subjects" => [
    "es"  => "Temas",
    "gal" => "Temas",
    "en"  => "Subjects",
    ],
  "subjects_list_admin" => [
    "es"  => "Administración de temas",
    "gal" => "Administración de temas",
    "en"  => "Subjects list",
    ],



# ...............................................................................................................
# ..########.....................................................................................................
# .....##........................................................................................................
# .....##........................................................................................................
# .....##........................................................................................................
# .....##........................................................................................................
# .....##........................................................................................................
# .....##........................................................................................................
# ...............................................................................................................

  "thank_you" => [
    "es"  => "Gracias.",
    "gal" => "Grazas.",
    "en"  => "Thank you.",
  ],
  "thumbnail" => [
    "es"  => "Miniatura",
    "gal" => "Miniatura",
    "en"  => "Thumbnail",
  ],
  "tip" => [
    "es"  => "Consejo",
    "gal" => "Consello",
    "en"  => "Tip",
  ],
  "title" => [
    "es"  => "Título",
    "gal" => "Título",
    "en"  => "Title",
  ],
  "type" => [
    "es"  => "Tipo",
    "gal" => "Tipo",
    "en"  => "Type",
  ],



# ...............................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ...#######.....................................................................................................
# ...............................................................................................................

  "unknown_email_or_username" => [
    "es"  => "Correo electrónico o nombre de usuario/a desconocido.",
    "gal" => "Correo electrónico ou nome de usuario/a descoñecido.",
    "en"  => "Unknown eMail address or username.",
    ],
  "untitled" => [
    "es"  => "Sin título",
    "gal" => "Sen título",
    "en"  => "Untitled",
    ],
  "url" => [
    "es"  => "URL",
    "gal" => "URL",
    "en"  => "URL",
    ],
  "users" => [
    "es"  => "Usuarios/as",
    "gal" => "Usuarios/as",
    "en"  => "Users",
    ],



# ...............................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ..##.....##....................................................................................................
# ...##...##.....................................................................................................
# ....##.##......................................................................................................
# .....###.......................................................................................................
# ...............................................................................................................

  "visibility" => [
    "es"  => "Visibilidad",
    "gal" => "Visibilidade",
    "en"  => "Visibility",
    ],
  "visible" => [
    "es"  => "Visible",
    "gal" => "Visible",
    "en"  => "Visible",
    ],



# ...............................................................................................................
# ..##......##...................................................................................................
# ..##..##..##...................................................................................................
# ..##..##..##...................................................................................................
# ..##..##..##...................................................................................................
# ..##..##..##...................................................................................................
# ..##..##..##...................................................................................................
# ...###..###....................................................................................................
# ...............................................................................................................

  "website" => [
    "es"  => "Sitio web",
    "gal" => "Sitio web",
    "en"  => "Website",
    ],
  "we_have_just_sent_an_email_to" => [
    "es"  => "Acabamos de enviar un correo electrónico a %s.",
    "gal" => "Vimos de enviar un correo electrónico a %s.",
    "en"  => "We've just sent an eMail to %s.",
    ],
  "we_have_just_sent_you_an_email" => [
    "es"  => "Acabamos de enviarte un correo electrónico.",
    "gal" => "Vimos de enviarche un correo electrónico.",
    "en"  => "We've just sent you an eMail.",
    ],
  "wrong_captcha_response" => [
    "es"  => "No has respondido correctamente al reCAPTCHA.",
    "gal" => "No respostaches correctamente o reCAPTCHA.",
    "en"  => "Wrong answer to reCAPTCHA.",
    ],
  "wrong_password_strength" => [
    "es"  => "La calidad de la contraseña está por debajo de lo aceptable.",
    "gal" => "A calidade do contrasinal está por debaixo do aceptable.",
    "en"  => "Password strength is lower than the required minimum strength.",
    ],



# ...............................................................................................................
# ..##.....##....................................................................................................
# ...##...##.....................................................................................................
# ....##.##......................................................................................................
# .....###.......................................................................................................
# ....##.##......................................................................................................
# ...##...##.....................................................................................................
# ..##.....##....................................................................................................
# ...............................................................................................................



# ...............................................................................................................
# ..##....##.....................................................................................................
# ...##..##......................................................................................................
# ....####.......................................................................................................
# .....##........................................................................................................
# .....##........................................................................................................
# .....##........................................................................................................
# .....##........................................................................................................
# ...............................................................................................................

  "year" => [
    "es"  => "Año",
    "gal" => "Ano",
    "en"  => "Year",
  ],
  "yes" => [
    "es"  => "Sí",
    "gal" => "Si",
    "en"  => "Yes",
  ],
  "you_are_going_to_delete" => [
    "es"  => "Vas a eliminar %s elemento%s.",
    "gal" => "Vas eliminar %s elemento%s.",
    "en"  => "You are going to delete %s item%s.",
    ],
  "you_are_going_to_delete_plural" => [
    "es"  => "s",
    "gal" => "s",
    "en"  => "s",
    ],
  "you_can_now_sign_in" => [
    "es"  => "Ya puedes iniciar tu sesión en",
    "gal" => "Xa podes iniciar a tua sesión en",
    "en"  => "You can now sign_in at",
    ],
  "your_password" => [
    "es"  => "Tu contraseña",
    "gal" => "O teu contrasinal",
    "en"  => "Your password",
  ],
  "your_new_password" => [
    "es"  => "Tu nueva contraseña",
    "gal" => "O teu novo contrasinal",
    "en"  => "Your new password",
  ],
  "your_password_has_been_changed" => [
    "es"  => "Tu contraseña para %s acaba de cambiarse.",
    "gal" => "O teu contrasinal para %s ven de cambiar.",
    "en"  => "Your password for %s has been changed.",
  ],



# ...............................................................................................................
# ..########.....................................................................................................
# .......##......................................................................................................
# ......##.......................................................................................................
# .....##........................................................................................................
# ....##.........................................................................................................
# ...##..........................................................................................................
# ..########.....................................................................................................
# ...............................................................................................................

  ];

?>
