<?php
// $Id: main.php,v 1.10 2003/05/02 18:19:43 okazu Exp $
//%%%%%%		Module Name phpBB  		%%%%%
//functions.php
define("_MDEX_ERROR","Erro");
define("_MDEX_NOPOSTS","N�o h� Posts");
define("_MDEX_GO","ir");

//index.php
define("_MDEX_FORUM","F�rum");
define("_MDEX_WELCOME","Bem vindo ao F�rum.");
define("_MDEX_TOPICS","T�picos");
define("_MDEX_POSTS","Mensagens");
define("_MDEX_LASTPOST","�ltima mensagem");
define("_MDEX_MODERATOR","Moderador");
define("_MDEX_NEWPOSTS","Novas mensagens");
define("_MDEX_NONEWPOSTS","N�o h� novas mensagens");
define("_MDEX_PRIVATEFORUM","F�rum privado");
define("_MDEX_BY","por"); // Posted by
define("_MDEX_TOSTART","Para acessar as mensagens, selecione abaixo o f�rum que deseja visitar.");
define("_MDEX_TOTALTOPICSC","Total de T�picos: ");
define("_MDEX_TOTALPOSTSC","Total de Mensagens: ");
define("_MDEX_TIMENOW","Hor�rio atual: %s");
define("_MDEX_LASTVISIT","Voc� visitou por �ltimo: %s");
define("_MDEX_ADVSEARCH","Busca Avan�ada");
define("_MDEX_POSTEDON","Enviado em: ");
define("_MDEX_SUBJECT","Assunto");

//page_header.php
define("_MDEX_MODERATEDBY","Moderado por");
define("_MDEX_SEARCH","Pesquisar");
define("_MDEX_SEARCHRESULTS","Resultado da pesquisa");
define("_MDEX_FORUMINDEX","�ndice do F�rum");
define("_MDEX_POSTNEW","Nova mensagem");
define("_MDEX_REGTOPOST","Registre-se para Enviar Msg");

//search.php
define("_MDEX_KEYWORDS","Palavras chave:");
define("_MDEX_SEARCHANY","Busca para QUAISQUER dos termos (Default)");
define("_MDEX_SEARCHALL","Busca para TODOS os termos");
define("_MDEX_SEARCHALLFORUMS","Pesquisar todos F�runs");
define("_MDEX_FORUMC","F�rum,");
define("_MDEX_SORTBY","Classificar por");
define("_MDEX_DATE","Data");
define("_MDEX_TOPIC","T�pico");
define("_MDEX_USERNAME","Usu�rio");
define("_MDEX_SEARCHIN","Pesquisar em");
define("_MDEX_BODY","Corpo");
define("_MDEX_NOMATCH","Nenhum registro coincide com a pergunta. Por favor amplie a sua pesquisa.");
define("_MDEX_POSTTIME","Data da mensagem");

//viewforum.php
define("_MDEX_REPLIES","Resposta");
define("_MDEX_POSTER","Enviado Por");
define("_MDEX_VIEWS","Visualizar");
define("_MDEX_MORETHAN","Novas Mensagens [ Popular ]");
define("_MDEX_MORETHAN2","N�o h� novas mensagens [ Popular ]");
define("_MDEX_TOPICSTICKY","T�pico Fixo");
define("_MDEX_TOPICLOCKED","T�pico Fechado");
define("_MDEX_LEGEND","Legenda");
define("_MDEX_NEXTPAGE","Pr�xima p�gina");
define("_MDEX_SORTEDBY","Por tipo");
define("_MDEX_TOPICTITLE","Nome do t�pico");
define("_MDEX_NUMBERREPLIES","n�mero de respostas");
define("_MDEX_TOPICPOSTER","Assunto T�pico");
define("_MDEX_LASTPOSTTIME","Data da ultima mensagem");
define("_MDEX_ASCENDING","Ordem ascendente");
define("_MDEX_DESCENDING","Ordem descendente");
define("_MDEX_FROMLASTDAYS","Dos �ltimos dias");
define("_MDEX_THELASTYEAR","Do ano passado");
define("_MDEX_BEGINNING","Desde o in�cio");

//viewtopic.php
define("_MDEX_AUTHOR","Autor");
define("_MDEX_LOCKTOPIC","Bloquear este t�pico");
define("_MDEX_UNLOCKTOPIC","Desbloquear este t�pico");
define("_MDEX_STICKYTOPIC","Fixar este t�pico");
define("_MDEX_UNSTICKYTOPIC","Desfixar este t�pico");
define("_MDEX_MOVETOPIC","Mover este t�pico");
define("_MDEX_DELETETOPIC","Apagar este t�pico");
define("_MDEX_TOP","Topo");
define("_MDEX_PARENT","Final");
define("_MDEX_PREVTOPIC","T�pico anterior");
define("_MDEX_NEXTTOPIC","Pr�ximo t�pico");

//forumform.inc
define("_MDEX_ABOUTPOST","Sobre escrever no F�rum");
define("_MDEX_ANONCANPOST","<b>Visitantes</b> podem criar t�picos novos e respostas a este f�rum");
define("_MDEX_PRIVATE","Este � um f�rum <b>Privado</b>. <br />Somente os usu�rios com acesso especial podem criar t�picos e respostas novas neste este f�rum");define("_MD_REGCANPOST","All <b>Registered</b> users can post new topics and replies to this forum");
define("_MDEX_MODSCANPOST","Somente <B>Moderadores e Administradores</b> Voc� n�o pode iniciar um novo t�pico, neste f�rum");
define("_MDEX_PREVPAGE","P�gina anterior");
define("_MDEX_QUOTE","Citar");

// ERROR messages
define("_MDEX_ERRORFORUM","ERRO: F�rum n�o selecionado!");
define("_MDEX_ERRORPOST","ERRO:  Mensagem n�o selecionada!");
define("_MDEX_NORIGHTTOPOST","Voc� n�o tem permiss�o para escrever neste f�rum.");
define("_MDEX_NORIGHTTOACCESS","Voc� n�o tem permiss�o para acessar este f�rum.");
define("_MDEX_ERRORTOPIC","ERRO: T�pico n�o selecionado!");
define("_MDEX_ERRORCONNECT","ERRO: N�o foi poss�vel conectar ao banco de dados.");
define("_MDEX_ERROREXIST","ERRO: O f�rum que voc� selecionou n�o existe. Por favor, tente novamente mais tarde.");
define("_MDEX_ERROROCCURED","Ocorreu um erro");
define("_MDEX_COULDNOTQUERY","N�o foi poss�vel consultar o banco de dados do f�rum.");
define("_MDEX_FORUMNOEXIST","Erro - O f�rum ou t�pico que voc� selecionou n�o existe. Por favor, tente novamente mais tarde.");
define("_MDEX_USERNOEXIST","Esse usu�rio n�o existe.Por favor volte mas tarde e procure novamente.");
define("_MDEX_COULDNOTREMOVE","Erro - N�o foi poss�vel remover mensagens do banco de dados!");
define("_MDEX_COULDNOTREMOVETXT","Erro - n�o foi poss�vel remover os textos das mensagens!");

//reply.php
define("_MDEX_ON","em"); //Posted on
define("_MDEX_USERWROTE","%s escreveu:"); // %s is username

//post.php
define("_MDEX_EDITNOTALLOWED","Voc� n�o tem permiss�o para editar esta mensagem!");
define("_MDEX_EDITEDBY","Editado por");
define("_MDEX_ANONNOTALLOWED","Visitantes an�nimos n�o t�m autoriza��o para enviar mensagens.<br>Por favor, registre-se.");
define("_MDEX_THANKSSUBMIT","Obrigado pela sua participa��o!");
define("_MDEX_REPLYPOSTED","Foi enviada uma resposta para o seu t�pico.");
define("_MDEX_HELLO","Ol� %s,");
define("_MDEX_URRECEIVING","Voc� est� recebendo este e-mail porque uma t�pico que voc� criou no f�rum do site %s foi respondido."); // %s is your site name
define("_MDEX_CLICKBELOW","Clique no link abaixo para ver o t�pico:");

//forumform.inc
define("_MDEX_YOURNAME","Nome:");
define("_MDEX_LOGOUT","Sair");
define("_MDEX_REGISTER","Registrar");
define("_MDEX_SUBJECTC","Assunto:");
define("_MDEX_MESSAGEICON","�cone da mensagem");
define("_MDEX_MESSAGEC","Mensagens:");
define("_MDEX_ALLOWEDHTML","Ativar HTML:");
define("_MDEX_OPTIONS","Op��es:");
define("_MDEX_POSTANONLY","Postado Anonimamente");
define("_MDEX_DISABLESMILEY","Desabilitar emoticons");
define("_MDEX_DISABLEHTML","Desabilitar html");
define("_MDEX_NEWPOSTNOTIFY", "Avise-me sobre novas mensagens neste t�pico");
define("_MDEX_ATTACHSIG","Inserir assinatura");
define("_MDEX_POST","Escrever");
define("_MDEX_SUBMIT","Enviar");
define("_MDEX_CANCELPOST","Cancelar");

// forumuserpost.php
define("_MDEX_ADD","Adicionar");
define("_MDEX_REPLY","Responder");

// topicmanager.php
define("_MDEX_YANTMOTFTYCPTF","Voc� n�o � o moderador deste f�rum, por isso, voc� n�o pode executar esta fun��o.");
define("_MDEX_TTHBRFTD","O t�pico foi retirado do banco de dados.");
define("_MDEX_RETURNTOTHEFORUM","Retornar ao f�rum");
define("_MDEX_RTTFI","Retornar ao �ndice do f�rum");
define("_MDEX_EPGBATA","Erro - Ocorreu um erro por favor volte e tente novamente.");
define("_MDEX_TTHBM","O t�pico foi movido.");
define("_MDEX_VTUT","Ver t�pico atualizado");
define("_MDEX_TTHBL","O t�pico foi bloqueado.");
define("_MDEX_TTHBS","O t�pico foi fixado.");
define("_MDEX_TTHBUS","O t�pico foi esfixado.");
define("_MDEX_VIEWTHETOPIC","Exibir t�pico");
define("_MDEX_TTHBU","O t�pico foi desbloqueado.");
define("_MDEX_OYPTDBATBOTFTTY","Clicando em EXCLUIR no final desta p�gina, o t�pico selecionado e todas as mensagens vinculadas ser�o <b>permanentemente</b> exclu�dos.");
define("_MDEX_OYPTMBATBOTFTTY","Clicando em MOVER no final desta p�gina, o t�pico selecionado e todas as mensagens vinculadas ser�o movidas para o f�rum selecionado.");
define("_MDEX_OYPTLBATBOTFTTY","Clicando em BLOQUEAR no final desta p�gina, o t�pico selecionado ser� bloqueado. Se desejar, voc� poder� desbloque�-lo posteriormente.");
define("_MDEX_OYPTUBATBOTFTTY","Clicando em DESBLOQUEAR no final desta p�gina, o t�pico selecionado ser� desbloqueado. Se desejar, voc� poder� bloque�-lo posteriormente.");
define("_MDEX_OYPTSBATBOTFTTY","Clicando em FIXAR no final desta p�gina, o t�pico selecionado ser� fixado. Se desejar, voc� poder� desfix�-lo posteriormente.");
define("_MDEX_OYPTTBATBOTFTTY","Clicando em DESFIXAR no final desta p�gina, o t�pico selecionado ser� desfixado. Se desejar, voc� poder� fix�-lo posteriormente.");
define("_MDEX_MOVETOPICTO","Mover t�pico para:");
define("_MDEX_NOFORUMINDB","N�o h� nenhum f�rum no banco de dados");
define("_MDEX_DATABASEERROR","Erro no banco de dados");
define("_MDEX_DELTOPIC","Apagar t�pico");

// delete.php
define("_MDEX_DELNOTALLOWED","Voc� n�o tem permiss�o para excluir esta mensagem.");
define("_MDEX_AREUSUREDEL","Voc� tem certeza de que deseja excluir esta mensagem e todas as outras vinculadas a ela?");
define("_MDEX_POSTSDELETED","Mensagem selecionada e todas as vinculadas foram exclu�das.");

// definitions moved from global.
define("_MDEX_THREAD","T�pico");
define("_MDEX_FROM","De");
define("_MDEX_JOINED","Cadastrado em");
define("_MDEX_ONLINE","Online");
define("_MDEX_BOTTOM","F�nal");

// ajout Herv�
define("_MDEX_POSTWITHOUTANSWER","Veja as mensagens sem resposta");

// Added version 1.5
define("_MDEX_ATTACH_FILE","Attach File");
define("_MDEX_ATTACHED_FILES","Attached File(s)");
define("_MDEX_UPLOAD_DBERROR_SAVE","Error while attaching file to the story");
define('_MDEX_UPLOAD_ERROR',"Error while uploading the file");
?>