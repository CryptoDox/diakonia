<?php
// $Id: main.php,v 1.10 2003/05/02 18:19:43 okazu Exp $
//%%%%%%		Module Name phpBB  		%%%%%
//functions.php
define("_MDEX_ERROR","Erro");
define("_MDEX_NOPOSTS","Não há Posts");
define("_MDEX_GO","ir");

//index.php
define("_MDEX_FORUM","Fórum");
define("_MDEX_WELCOME","Bem vindo ao Fórum.");
define("_MDEX_TOPICS","Tópicos");
define("_MDEX_POSTS","Mensagens");
define("_MDEX_LASTPOST","Última mensagem");
define("_MDEX_MODERATOR","Moderador");
define("_MDEX_NEWPOSTS","Novas mensagens");
define("_MDEX_NONEWPOSTS","Não há novas mensagens");
define("_MDEX_PRIVATEFORUM","Fórum privado");
define("_MDEX_BY","por"); // Posted by
define("_MDEX_TOSTART","Para acessar as mensagens, selecione abaixo o fórum que deseja visitar.");
define("_MDEX_TOTALTOPICSC","Total de Tópicos: ");
define("_MDEX_TOTALPOSTSC","Total de Mensagens: ");
define("_MDEX_TIMENOW","Horário atual: %s");
define("_MDEX_LASTVISIT","Você visitou por último: %s");
define("_MDEX_ADVSEARCH","Busca Avançada");
define("_MDEX_POSTEDON","Enviado em: ");
define("_MDEX_SUBJECT","Assunto");

//page_header.php
define("_MDEX_MODERATEDBY","Moderado por");
define("_MDEX_SEARCH","Pesquisar");
define("_MDEX_SEARCHRESULTS","Resultado da pesquisa");
define("_MDEX_FORUMINDEX","Índice do Fórum");
define("_MDEX_POSTNEW","Nova mensagem");
define("_MDEX_REGTOPOST","Registre-se para Enviar Msg");

//search.php
define("_MDEX_KEYWORDS","Palavras chave:");
define("_MDEX_SEARCHANY","Busca para QUAISQUER dos termos (Default)");
define("_MDEX_SEARCHALL","Busca para TODOS os termos");
define("_MDEX_SEARCHALLFORUMS","Pesquisar todos Fóruns");
define("_MDEX_FORUMC","Fórum,");
define("_MDEX_SORTBY","Classificar por");
define("_MDEX_DATE","Data");
define("_MDEX_TOPIC","Tópico");
define("_MDEX_USERNAME","Usuário");
define("_MDEX_SEARCHIN","Pesquisar em");
define("_MDEX_BODY","Corpo");
define("_MDEX_NOMATCH","Nenhum registro coincide com a pergunta. Por favor amplie a sua pesquisa.");
define("_MDEX_POSTTIME","Data da mensagem");

//viewforum.php
define("_MDEX_REPLIES","Resposta");
define("_MDEX_POSTER","Enviado Por");
define("_MDEX_VIEWS","Visualizar");
define("_MDEX_MORETHAN","Novas Mensagens [ Popular ]");
define("_MDEX_MORETHAN2","Não há novas mensagens [ Popular ]");
define("_MDEX_TOPICSTICKY","Tópico Fixo");
define("_MDEX_TOPICLOCKED","Tópico Fechado");
define("_MDEX_LEGEND","Legenda");
define("_MDEX_NEXTPAGE","Próxima página");
define("_MDEX_SORTEDBY","Por tipo");
define("_MDEX_TOPICTITLE","Nome do tópico");
define("_MDEX_NUMBERREPLIES","número de respostas");
define("_MDEX_TOPICPOSTER","Assunto Tópico");
define("_MDEX_LASTPOSTTIME","Data da ultima mensagem");
define("_MDEX_ASCENDING","Ordem ascendente");
define("_MDEX_DESCENDING","Ordem descendente");
define("_MDEX_FROMLASTDAYS","Dos últimos dias");
define("_MDEX_THELASTYEAR","Do ano passado");
define("_MDEX_BEGINNING","Desde o início");

//viewtopic.php
define("_MDEX_AUTHOR","Autor");
define("_MDEX_LOCKTOPIC","Bloquear este tópico");
define("_MDEX_UNLOCKTOPIC","Desbloquear este tópico");
define("_MDEX_STICKYTOPIC","Fixar este tópico");
define("_MDEX_UNSTICKYTOPIC","Desfixar este tópico");
define("_MDEX_MOVETOPIC","Mover este tópico");
define("_MDEX_DELETETOPIC","Apagar este tópico");
define("_MDEX_TOP","Topo");
define("_MDEX_PARENT","Final");
define("_MDEX_PREVTOPIC","Tópico anterior");
define("_MDEX_NEXTTOPIC","Próximo tópico");

//forumform.inc
define("_MDEX_ABOUTPOST","Sobre escrever no Fórum");
define("_MDEX_ANONCANPOST","<b>Visitantes</b> podem criar tópicos novos e respostas a este fórum");
define("_MDEX_PRIVATE","Este é um fórum <b>Privado</b>. <br />Somente os usuários com acesso especial podem criar tópicos e respostas novas neste este fórum");define("_MD_REGCANPOST","All <b>Registered</b> users can post new topics and replies to this forum");
define("_MDEX_MODSCANPOST","Somente <B>Moderadores e Administradores</b> Você não pode iniciar um novo tópico, neste fórum");
define("_MDEX_PREVPAGE","Página anterior");
define("_MDEX_QUOTE","Citar");

// ERROR messages
define("_MDEX_ERRORFORUM","ERRO: Fórum não selecionado!");
define("_MDEX_ERRORPOST","ERRO:  Mensagem não selecionada!");
define("_MDEX_NORIGHTTOPOST","Você não tem permissão para escrever neste fórum.");
define("_MDEX_NORIGHTTOACCESS","Você não tem permissão para acessar este fórum.");
define("_MDEX_ERRORTOPIC","ERRO: Tópico não selecionado!");
define("_MDEX_ERRORCONNECT","ERRO: Não foi possível conectar ao banco de dados.");
define("_MDEX_ERROREXIST","ERRO: O fórum que você selecionou não existe. Por favor, tente novamente mais tarde.");
define("_MDEX_ERROROCCURED","Ocorreu um erro");
define("_MDEX_COULDNOTQUERY","Não foi possível consultar o banco de dados do fórum.");
define("_MDEX_FORUMNOEXIST","Erro - O fórum ou tópico que você selecionou não existe. Por favor, tente novamente mais tarde.");
define("_MDEX_USERNOEXIST","Esse usuário não existe.Por favor volte mas tarde e procure novamente.");
define("_MDEX_COULDNOTREMOVE","Erro - Não foi possível remover mensagens do banco de dados!");
define("_MDEX_COULDNOTREMOVETXT","Erro - não foi possível remover os textos das mensagens!");

//reply.php
define("_MDEX_ON","em"); //Posted on
define("_MDEX_USERWROTE","%s escreveu:"); // %s is username

//post.php
define("_MDEX_EDITNOTALLOWED","Você não tem permissão para editar esta mensagem!");
define("_MDEX_EDITEDBY","Editado por");
define("_MDEX_ANONNOTALLOWED","Visitantes anônimos não têm autorização para enviar mensagens.<br>Por favor, registre-se.");
define("_MDEX_THANKSSUBMIT","Obrigado pela sua participação!");
define("_MDEX_REPLYPOSTED","Foi enviada uma resposta para o seu tópico.");
define("_MDEX_HELLO","Olá %s,");
define("_MDEX_URRECEIVING","Você está recebendo este e-mail porque uma tópico que você criou no fórum do site %s foi respondido."); // %s is your site name
define("_MDEX_CLICKBELOW","Clique no link abaixo para ver o tópico:");

//forumform.inc
define("_MDEX_YOURNAME","Nome:");
define("_MDEX_LOGOUT","Sair");
define("_MDEX_REGISTER","Registrar");
define("_MDEX_SUBJECTC","Assunto:");
define("_MDEX_MESSAGEICON","Ícone da mensagem");
define("_MDEX_MESSAGEC","Mensagens:");
define("_MDEX_ALLOWEDHTML","Ativar HTML:");
define("_MDEX_OPTIONS","Opções:");
define("_MDEX_POSTANONLY","Postado Anonimamente");
define("_MDEX_DISABLESMILEY","Desabilitar emoticons");
define("_MDEX_DISABLEHTML","Desabilitar html");
define("_MDEX_NEWPOSTNOTIFY", "Avise-me sobre novas mensagens neste tópico");
define("_MDEX_ATTACHSIG","Inserir assinatura");
define("_MDEX_POST","Escrever");
define("_MDEX_SUBMIT","Enviar");
define("_MDEX_CANCELPOST","Cancelar");

// forumuserpost.php
define("_MDEX_ADD","Adicionar");
define("_MDEX_REPLY","Responder");

// topicmanager.php
define("_MDEX_YANTMOTFTYCPTF","Você não é o moderador deste fórum, por isso, você não pode executar esta função.");
define("_MDEX_TTHBRFTD","O tópico foi retirado do banco de dados.");
define("_MDEX_RETURNTOTHEFORUM","Retornar ao fórum");
define("_MDEX_RTTFI","Retornar ao índice do fórum");
define("_MDEX_EPGBATA","Erro - Ocorreu um erro por favor volte e tente novamente.");
define("_MDEX_TTHBM","O tópico foi movido.");
define("_MDEX_VTUT","Ver tópico atualizado");
define("_MDEX_TTHBL","O tópico foi bloqueado.");
define("_MDEX_TTHBS","O tópico foi fixado.");
define("_MDEX_TTHBUS","O tópico foi esfixado.");
define("_MDEX_VIEWTHETOPIC","Exibir tópico");
define("_MDEX_TTHBU","O tópico foi desbloqueado.");
define("_MDEX_OYPTDBATBOTFTTY","Clicando em EXCLUIR no final desta página, o tópico selecionado e todas as mensagens vinculadas serão <b>permanentemente</b> excluídos.");
define("_MDEX_OYPTMBATBOTFTTY","Clicando em MOVER no final desta página, o tópico selecionado e todas as mensagens vinculadas serão movidas para o fórum selecionado.");
define("_MDEX_OYPTLBATBOTFTTY","Clicando em BLOQUEAR no final desta página, o tópico selecionado será bloqueado. Se desejar, você poderá desbloqueá-lo posteriormente.");
define("_MDEX_OYPTUBATBOTFTTY","Clicando em DESBLOQUEAR no final desta página, o tópico selecionado será desbloqueado. Se desejar, você poderá bloqueá-lo posteriormente.");
define("_MDEX_OYPTSBATBOTFTTY","Clicando em FIXAR no final desta página, o tópico selecionado será fixado. Se desejar, você poderá desfixá-lo posteriormente.");
define("_MDEX_OYPTTBATBOTFTTY","Clicando em DESFIXAR no final desta página, o tópico selecionado será desfixado. Se desejar, você poderá fixá-lo posteriormente.");
define("_MDEX_MOVETOPICTO","Mover tópico para:");
define("_MDEX_NOFORUMINDB","Não há nenhum fórum no banco de dados");
define("_MDEX_DATABASEERROR","Erro no banco de dados");
define("_MDEX_DELTOPIC","Apagar tópico");

// delete.php
define("_MDEX_DELNOTALLOWED","Você não tem permissão para excluir esta mensagem.");
define("_MDEX_AREUSUREDEL","Você tem certeza de que deseja excluir esta mensagem e todas as outras vinculadas a ela?");
define("_MDEX_POSTSDELETED","Mensagem selecionada e todas as vinculadas foram excluídas.");

// definitions moved from global.
define("_MDEX_THREAD","Tópico");
define("_MDEX_FROM","De");
define("_MDEX_JOINED","Cadastrado em");
define("_MDEX_ONLINE","Online");
define("_MDEX_BOTTOM","Fínal");

// ajout Hervé
define("_MDEX_POSTWITHOUTANSWER","Veja as mensagens sem resposta");

// Added version 1.5
define("_MDEX_ATTACH_FILE","Attach File");
define("_MDEX_ATTACHED_FILES","Attached File(s)");
define("_MDEX_UPLOAD_DBERROR_SAVE","Error while attaching file to the story");
define('_MDEX_UPLOAD_ERROR',"Error while uploading the file");
?>