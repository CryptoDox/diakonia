<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * XOOPS Poll Class Definitions
 *
 * @copyright::  {@link http://sourceforge.net/projects/xoops/ The XOOPS Project}
 * @license::    {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @package::    xoopspoll
 * @subpackage:: class
 * @since::		 1.40
 * @author::     zyspec <owners@zyspec.com>
 * @version::    $Id: poll.php 12482 2014-04-25 12:08:17Z beckmi $
 */
defined('XOOPS_ROOT_PATH') or die('Restricted access');

class XoopspollPoll extends XoopsObject
{
    /**
     * XoopspollPoll::__construct()
     *
    **/
    public function __construct(&$id=null)
    {
        parent::__construct();
//        $timestamp = xoops_getUserTimestamp(time());
        $current_timestamp = time();
        xoops_load('constants', 'xoopspoll');
        $this->initVar('poll_id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('question', XOBJ_DTYPE_TXTBOX, null, true, 255);
        $this->initVar('description', XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('user_id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('start_time', XOBJ_DTYPE_INT, $current_timestamp, false);
        $this->initVar('end_time', XOBJ_DTYPE_INT, ($current_timestamp + XoopspollConstants::DEFAULT_POLL_DURATION), true);
        $this->initVar('votes', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('voters', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('display', XOBJ_DTYPE_INT, XoopspollConstants::DISPLAY_POLL_IN_BLOCK, false);
        $this->initVar('visibility', XOBJ_DTYPE_INT, XoopspollConstants::HIDE_NEVER, false);
        $this->initVar('anonymous', XOBJ_DTYPE_INT, XoopspollConstants::ANONYMOUS_VOTING_DISALLOWED, false);
        $this->initVar('weight', XOBJ_DTYPE_INT, XoopspollConstants::DEFAULT_WEIGHT, false);
        $this->initVar('multiple', XOBJ_DTYPE_INT, XoopspollConstants::NOT_MULTIPLE_SELECT_POLL, false);
        $this->initVar("multilimit", XOBJ_DTYPE_INT, XoopspollConstants::MULTIPLE_SELECT_LIMITLESS, false);
        $this->initVar('mail_status', XOBJ_DTYPE_INT, XoopspollConstants::POLL_NOT_MAILED, false);
        $this->initVar('mail_voter', XOBJ_DTYPE_INT, XoopspollConstants::NOT_MAIL_POLL_TO_VOTER, false);

        /**
         * {@internal This code added to support previous versions of newbb/xForum}
         */
        if (!empty($id)) {
            $err_msg = __CLASS__ . " instantiation with 'id' set is deprecated since Xoopspoll 1.40, please use XoopspollPollHandler instead.";
            if (isset($GLOBALS['xoopsLogger'])) {
                $GLOBALS['xoopsLogger']->addDeprecated($err_msg);
            } else {
                trigger_error($err_msg, E_USER_WARNING);
            }

            if (is_array($id)) {
                $this->assignVars($id);
            } else {
                $pHandler = xoops_getmodulehandler('poll', 'xoopspoll');
                $this->assignVars($pHandler->getAll(new Criteria('id', $id, '=')), null, false);
                unset($pHandler);
            }
        }
    }

    /**
     *
     * XoopspollPoll::XoopspollPoll()
     * @access public
     */
    public function XoopspollPoll(&$id=null)
    {
        $this->__construct($id);
    }

    /**
     * Set display string for class
     */
    public function __toString()
    {
        return $this->getVar('question');
    }
    /**
     *
     * Find out if poll has expired
     * @access public
     * @uses XoopspollPoll::getVar()
     * @return bool
     */
    public function hasExpired()
    {
        $ret = true;
        if ($this->getVar('end_time') > time()) {
            $ret = false;
        }

        return $ret;
    }

    /**
     *
     * Determine if user is allowed to vote in this poll
     * @uses XoopsUser
     * @uses XoopspollPoll::getVar()
     * @access public
     * @return bool
     */
    public function isAllowedToVote()
    {
        $ret = false;
        if ((($GLOBALS['xoopsUser'] instanceof XoopsUser)
              && (($GLOBALS['xoopsUser']->uid() > 0) && $GLOBALS['xoopsUser']->isActive()))
              || (XoopspollConstants::ANONYMOUS_VOTING_ALLOWED == $this->getVar('anonymous'))) {
            $ret = true;
        }

        return $ret;
    }

    /**
     * @access public
     * @uses xoops_getmodulehandler()
     * @uses CriteriaCompo()
     * @uses XoopspollPollHandler::getAll()
     * @uses XoopspollLogHandler
     * @param  int    $optionId
     * @param  string $ip       ip address of voter
     * @param  int    $uid
     * @return bool   true vote entered, false voting failed
     */
    public function vote($optionId, $ip, $time)
    {
        if (!empty($optionId) && self::isAllowedToVote()) {
            $voteTime = empty($time) ? time() : intval($time);
            $uid = ($GLOBALS['xoopsUser'] instanceof XoopsUser) ? $GLOBALS['xoopsUser']->uid() : 0;
            $logHandler =& xoops_getmodulehandler('log', 'xoopspoll');
            $optHandler =& xoops_getmodulehandler('option', 'xoopspoll');
            $optsIdArray = (array) $optionId; // type cast to make sure it's an array
            $optsIdArray = array_map('intval', $optsIdArray); // make sure values are integers
            /* check to make sure voter hasn't selected too many options */
            if (!$this->getVar('multiple')
                || ($this->getVar('multiple')
                    && ((XoopspollConstants::MULTIPLE_SELECT_LIMITLESS == $this->getVar('multilimit'))
                        || (count($optsIdArray) <= $this->getVar('multilimit'))))
                )
            {
                $criteria = new CriteriaCompo();
                $criteria->add(new Criteria('option_id', '(' . implode(',', $optsIdArray) . ')', 'IN'));
                $optionObjs = $optHandler->getAll($criteria);
                foreach ($optionObjs as $optionObj) {
//                    if ($this->getVar('poll_id') == $optionObj->getVar('poll_id')) {
                    $log = $logHandler->create();
                    //force ip if invalid
                    $ip = (filter_var($ip, FILTER_VALIDATE_IP)) ? $ip : "255.255.255.254";
                    $logVars = array(
                                 'poll_id'   => $this->getVar('poll_id'),
                                 'option_id' => intval($optionObj->getVar('option_id')),
                                 'ip'        => $ip,
                                 'user_id'   => $uid,
                                 'time'      => $voteTime
                    );
                    $log->setVars($logVars);
                    if (false !== $logHandler->insert($log)) {
                        $optHandler->updateCount($optionObj);
                    }
                }
                // now send voter an email if the poll is set to allow it (if the user is not anon)
                if (XoopspollConstants::MAIL_POLL_TO_VOTER == ($this->getVar('mail_voter')) && (!empty($uid))) {
                    $this->notifyVoter($GLOBALS['xoopsUser']);
                }

                return true;
            }
        }

        return false;
    }

    /**
     * Gets number of comments for this poll
     * @access public
     * @param integer poll_id
     * @return integer count of comments for this poll_id
     */
    public function getComments()
    {
        $modHandler =& xoops_gethandler('module');
        $pollModule = $modHandler->getByDirname('xoopspoll');

        $commentHandler =& xoops_gethandler('comment');
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('com_itemid', $this->getVar('poll_id'), '='));
        $criteria->add(new Criteria('com_modid', $pollModule->getVar('mid'), '='));
        $commentCount = $commentHandler->getCount($criteria);
        $commentCount = intval($commentCount);

        return $commentCount;
    }

    /**
     *
     * display the poll form
     * @param string $rtnPage   where to send the form result
     * @param string $rtnMethod return method  get|post
     */
    public function renderForm($rtnPage, $rtnMethod='post', $addHidden=array())
    {
        xoops_load('constants', 'xoopspoll');
        xoops_load('pollUtility', 'xoopspoll');
        xoops_load('xoopsformloader');
        xoops_load('FormDateTimePicker', 'xoopspoll');
        $myts =& MyTextSanitizer::getInstance();

        $rtnMethod = mb_strtolower($rtnMethod);
        // force form to use xoopsSecurity if it's a 'post' form
        $rtnSecurity = ('post' == mb_strtolower($rtnMethod)) ? true : false;

        //  set form titles, etc. depending on if it's a new object or not
        if ($this->isNew()) {
            $formTitle = _AM_XOOPSPOLL_CREATENEWPOLL;
            $this->setVar('user_id', $GLOBALS['xoopsUser']->getVar('uid'));
        } else {
            $formTitle = _AM_XOOPSPOLL_EDITPOLL;
        }

        /*  create the form */
        $pollForm = new XoopsThemeForm(ucwords($formTitle), 'poll_form', $rtnPage, $rtnMethod, $rtnSecurity);
        $authorLabel = new XoopsFormLabel(_AM_XOOPSPOLL_AUTHOR, "<a href='" . $GLOBALS['xoops']->url("userinfo.php") . "?uid=" . $this->getVar('user_id') . "' target='_blank'>" . ucfirst(XoopsUser::getUnameFromId($this->getVar('user_id'))) . "</a>");
        $pollForm->addElement($authorLabel);
        $pollForm->addElement(new XoopsFormText(_AM_XOOPSPOLL_DISPLAYORDER, "weight", 6, 5, $this->getVar('weight')));
        $questionText = new XoopsFormText(_AM_XOOPSPOLL_POLLQUESTION, "question", 50, 255, $this->getVar('question', 'E'));
        $pollForm->addElement($questionText, true);
/*
        $descTarea = new XoopsFormTextarea(_AM_XOOPSPOLL_POLLDESC, "description", $this->getVar('description', 'E'));
        $pollForm->addElement($descTarea);
*/
        $modHandler =& xoops_gethandler('module');
        $pollModule = $modHandler->getByDirname('xoopspoll');

        $module_handler =& xoops_gethandler("module");
        $config_handler =& xoops_gethandler("config");
//        $xp_module      =& $module_handler->getByDirname("xoopspoll");
//        $module_id      = $xp_module->getVar("mid");
//        $xp_config      =& $config_handler->getConfigsByCat(0, $module_id);
        $sys_module     =& $module_handler->getByDirname("system");
        $sys_id         = $sys_module->getVar("mid");
        $sys_config     =& $config_handler->getConfigsByCat(0, $sys_id);

        $editorConfigs = array(
//                           'editor' => $GLOBALS['xoopsModuleConfig']['useeditor'],
//                           'editor' => $xp_config['useeditor'],
                           'editor' => $sys_config['general_editor'],
                           'rows'   => 15,
                           'cols'   => 60,
                           'width'  => '100%',
                           'height' => '350px',
                           'name'   => 'description',
//                           'value'  => $myts->stripSlashesGPC($this->getVar('description'))
                           'value'  => $myts->htmlSpecialChars($this->getVar('description'))
        );
        $desc_text = new XoopsFormEditor(_AM_XOOPSPOLL_POLLDESC, 'description', $editorConfigs);
        $pollForm->addElement($desc_text);

        $author = new XoopsUser($this->getVar('user_id'));

        /* setup time variables */
        $timeTray = new XoopsFormElementTray( _AM_XOOPSPOLL_POLL_TIMES, "&nbsp;&nbsp;", "time_tray");

        $xuCurrentTimestamp = xoops_getUserTimestamp(time());
        $xuCurrentFormatted = ucfirst(date(_MEDIUMDATESTRING, $xuCurrentTimestamp));
        $xuStartTimestamp   = xoops_getUserTimestamp($this->getVar('start_time'));
        $xuEndTimestamp     = xoops_getUserTimestamp($this->getVar('end_time'));

        /* display start/end time fields on form */
        $startTimeText = new XoopspollFormDateTimePicker("<div class='bold'>" . _AM_XOOPSPOLL_START_TIME . "<br />"
                         . "<span class='x-small'>" . _AM_XOOPSPOLL_FORMAT . "<br />"
                         . sprintf(_AM_XOOPSPOLL_CURRENTTIME, $xuCurrentFormatted) . "</span></div>"
                         , 'xu_start_time'
                         , 20
                         , $xuStartTimestamp);
        if (!$this->hasExpired()) {
            $endTimeText = new XoopspollFormDateTimePicker("<div class='bold middle'>" . _AM_XOOPSPOLL_EXPIRATION . "</div>"
                           , 'xu_end_time'
                            , 20
                            , $xuEndTimestamp);
        } else {
/*
            $extra = "";
            foreach ($addHidden as $key=>$value) {
                $extra="&amp;{$key}={$value}";
            }

            $xuEndFormattedTime = ucfirst(date(_MEDIUMDATESTRING, $xuEndTimestamp));
            $endTimeText = new XoopsFormLabel("<div class='bold middle'>" . _AM_XOOPSPOLL_EXPIRATION,
                             sprintf(_AM_XOOPSPOLL_EXPIREDAT, $xuEndFormattedTime)
                           . "<br /><a href='{$rtnPage}?op=restart&amp;poll_id="
                           . $this->getVar('poll_id') . "{$extra}'>" . _AM_XOOPSPOLL_RESTART . "</a></div>");
        }
*/
            $extra = (is_array($addHidden)) ? $addHidden : array();
            $extra = array_merge($extra, array('op'=>'restart', 'poll_id' => $this->getVar('poll_id')));
            $query = http_build_query($extra);
            $query = htmlentities($query, ENT_QUOTES);
            $xuEndFormattedTime = ucfirst(date(_MEDIUMDATESTRING, $xuEndTimestamp));
            $endTimeText = new XoopsFormLabel("<div class='bold middle'>" . _AM_XOOPSPOLL_EXPIRATION,
                             sprintf(_AM_XOOPSPOLL_EXPIREDAT, $xuEndFormattedTime)
                           . "<br /><a href='{$rtnPage}?{$query}'>" . _AM_XOOPSPOLL_RESTART . "</a></div>");
        }

        $timeTray->addElement($startTimeText);
        $timeTray->addElement($endTimeText, true);
        $pollForm->addElement($timeTray);
        /* allow anonymous voting */
        $pollForm->addElement(new XoopsFormRadioYN(_AM_XOOPSPOLL_ALLOWANONYMOUS, "anonymous", $this->getVar('anonymous')));
        /* add poll options to the form */
        $pollForm->addElement(new XoopsFormLabel(_AM_XOOPSPOLL_OPTION_SETTINGS, "<hr class='center' />"));
        $multiCount = ($this->getVar('multiple') > 0) ? $this->getVar('multiple') : "";
        $pollForm->addElement(new XoopsFormRadioYN(_AM_XOOPSPOLL_ALLOWMULTI, "multiple", $this->getVar('multiple')));

        /* add multiple selection limit to multiple selection polls */
        $multiLimit = new XoopsFormText(_AM_XOOPSPOLL_MULTI_LIMIT . '<br/><small>' ._AM_XOOPSPOLL_MULTI_LIMIT_DESC . '</small>', "multilimit", 6, 5, $this->getVar('multilimit'));
        $pollForm->addElement($multiLimit);

        $optHandler =& xoops_getmodulehandler('option', 'xoopspoll');
        $optionTray = $optHandler->renderOptionFormTray($this->getVar('poll_id'));
        $pollForm->addElement($optionTray);

        /* add preferences to the form */
        $pollForm->addElement(new XoopsFormLabel(_AM_XOOPSPOLL_PREFERENCES, "<hr class='center' />"));
        $visSelect = new XoopsFormSelect(_AM_XOOPSPOLL_BLIND, 'visibility', $this->getVar('visibility'), 1, false);
        /**
         * {@internal Do NOT add/delete from $vis_options after the module has been installed}
         */
        xoops_loadLanguage('main', 'xoopspoll');
        $visSelect->addOptionArray(XoopspollPollUtility::getVisibilityArray());
        $pollForm->addElement($visSelect);
        $notifyValue = (XoopspollConstants::POLL_MAILED != $this->getVar('mail_status')) ? XoopspollConstants::NOTIFICATION_ENABLED : XoopspollConstants::NOTIFICATION_DISABLED;
        $pollForm->addElement(new XoopsFormRadioYN(_AM_XOOPSPOLL_NOTIFY, "notify", $notifyValue));

        // Add "notify voter" in the form
        $mail_voter_yn = new XoopsFormRadioYN(_AM_XOOPSPOLL_NOTIFY_VOTER, "mail_voter", $this->getVar('mail_voter'));
        $pollForm->addElement($mail_voter_yn);

        $pollForm->addElement(new XoopsFormRadioYN(_AM_XOOPSPOLL_DISPLAYBLOCK, "display", $this->getVar('display')));

        foreach ($addHidden as $key=>$value) {
            $pollForm->addElement(new XoopsFormHidden($key, $value));
        }
        $pollForm->addElement(new XoopsFormHidden('op', 'update'));
        $pollForm->addElement(new XoopsFormHidden('poll_id', $this->getVar('poll_id')));
        $pollForm->addElement(new XoopsFormHidden('user_id', $this->getVar('user_id')));
        $pollForm->addElement(new XoopsFormButtonTray('submit', _SUBMIT, null, null, true));
//        $pollForm->addElement(new XoopsFormButtonTray( "form_submit", _SUBMIT, "submit", "", true));
        return $pollForm->display();
    }
    /**
     *
     * Method determines if current user can view the results of this poll
     * @return mixed visibility of this poll's results (true if visible, msg if not)
     */
    public function isResultVisible()
    {
        xoops_loadLanguage('main', 'xoopspoll');
        switch ($this->getVar('visibility')) {
            case XoopspollConstants::HIDE_ALWAYS:  // always hide the results
            default:
                $isVisible = false;
                $visibleMsg = _MD_XOOPSPOLL_HIDE_ALWAYS_MSG;
                break;
            case XoopspollConstants::HIDE_END:  // hide the results until the poll ends
                if (!$this->hasExpired()) {
                    $visibleMsg = _MD_XOOPSPOLL_HIDE_END_MSG;
                    $isVisible = false;
                } else {
                    $isVisible = true;
                }
                break;
            case XoopspollConstants::HIDE_VOTED: // hide the results until user votes
                $logHandler =& xoops_getmodulehandler('log', 'xoopspoll');
                $uid = (($GLOBALS['xoopsUser'] instanceof XoopsUser) && ($GLOBALS['xoopsUser']->getVar('uid') > 0)) ? $GLOBALS['xoopsUser']->getVar('uid') : 0;
                if ($this->isAllowedToVote() && ($logHandler->hasVoted($this->getVar('poll_id'), xoops_getenv('REMOTE_ADDR'), $uid))) {
                    $isVisible = true;
                } else {
                    $visibleMsg = _MD_XOOPSPOLL_HIDE_VOTED_MSG;
                    $isVisible = false;
                }
                break;
            case XoopspollConstants::HIDE_NEVER:  // never hide the results - always show
                $isVisible = true;
                break;
        }

        return (true == $isVisible) ? true : $visibleMsg;
    }

    /**
     * Send copy of vote to the user at time of vote (if selected)
     *
     *  @param XoopsUser $user the Xoops user object for this user
     *  @return bool send status
    */
    function notifyVoter($user = null)
    {
        if (($user instanceof XoopsUser) && (XoopspollConstants::MAIL_POLL_TO_VOTER == $this->getVar('mail_voter'))) {
            xoops_loadLanguage('main', 'xoopspoll');
            $xoopsMailer =& xoops_getMailer();
            $xoopsMailer->useMail();

            $language = $GLOBALS['xoopsConfig']['language'];
            $templateDir = $GLOBALS['xoops']->path("modules" . DIRECTORY_SEPARATOR
                           . DIRECTORY_SEPARATOR . "xoopspoll"
                           . DIRECTORY_SEPARATOR . 'language'
                           . DIRECTORY_SEPARATOR . $language
                           . DIRECTORY_SEPARATOR . 'mail_template' . DIRECTORY_SEPARATOR
            );
            $templateFilename = 'mail_voter.tpl';
            if (!file_exists($templateDir . $templateFilename)) {
                $language = 'english';
            }

            $xoopsMailer->setTemplateDir($templateDir);
            $xoopsMailer->setTemplate($templateFilename);

            $author = new XoopsUser($this->getVar('user_id'));
            $xoopsMailer->setFromUser($author);
            $xoopsMailer->setToUsers($user);

            $xoopsMailer->assign("POLL_QUESTION", $this->getVar("question"));

            $xuEndTimestamp = xoops_getUserTimestamp($this->getVar('end_time'));
            $xuEndFormattedTime = ucfirst(date(_MEDIUMDATESTRING, $xuEndTimestamp));
            // on the outside chance this expired right after the user voted.
            if ($this->hasExpired()) {
                $xoopsMailer->assign("POLL_END", sprintf(_MD_XOOPSPOLL_ENDED_AT, $xuEndFormattedTime));
            } else {
                $xoopsMailer->assign("POLL_END", sprintf(_MD_XOOPSPOLL_ENDS_ON, $xuEndFormattedTime));
            }

            $visibleText = "";
            switch ($this->getVar('visibility')) {
                case XoopspollConstants::HIDE_ALWAYS:  // always hide the results - election mode
                    default:
                    break;
                case XoopspollConstants::HIDE_END:  // hide the results until the poll ends
                    if ($this->hasExpired()) {
                        $visibleText = _MD_XOOPSPOLL_SEE_AT;
                    } else {
                        $visibleText = _MD_XOOPSPOLL_SEE_AFTER;
                    }
                    break;
                case XoopspollConstants::HIDE_VOTED: // hide the results until user votes
                case XoopspollConstants::HIDE_NEVER:  // never hide the results - always show
                    $visibleText = _MD_XOOPSPOLL_SEE_AT;
                    break;
            }
            $xoopsMailer->assign("POLL_VISIBLE", $visibleText);
            if (!empty($visibleText)) {
                $xoopsMailer->assign("LOCATION", $GLOBALS['xoops']->url("modules/xoopspoll/pollresults.php?poll_id=" . $this->getVar("poll_id")));
            } else {
                $xoopsMailer->assign("LOCATION", "");
            }

            $xoopsMailer->assign("POLL_ID", $this->getVar("poll_id"));
            $xoopsMailer->assign("SITENAME", $GLOBALS['xoopsConfig']['sitename']);
            $xoopsMailer->assign("ADMINMAIL", $GLOBALS['xoopsConfig']['adminmail']);
            $xoopsMailer->assign("SITEURL", $GLOBALS['xoops']->url());

            $xoopsMailer->setSubject(sprintf(_MD_XOOPSPOLL_YOURVOTEAT, $user->uname(),$GLOBALS['xoopsConfig']['sitename']));
            $status = $xoopsMailer->send();
        } else {
          $status = false;
        }

        return $status;
    }

/**#@+
 * The following method is provided for backward compatibility with newbb/xforum
 * @deprecated since Xoopspoll 1.40, please use XoopspollPollHandler & XoopspollPoll
 */
    /**
     *
     * deletes the object from the database
     * @return mixed results of deleting poll from db
     */
    function delete()
    {
        $GLOBALS['xoopsLogger']->addDeprecated(__CLASS__ . "::" . __METHOD__ . " is deprecated since Xoopspoll 1.40, please use XoopspollPollHandler::" . __METHOD__ . " instead.");
        $pollHandler = self::getStaticPollHandler();

        return $pollHandler->delete($this->poll);
    }
    /**
     *
     * update the vote counter for this poll
     * @returns bool results of update counter
     */
    function updateCount()
    {
        $GLOBALS['xoopsLogger']->addDeprecated(__CLASS__ . "::" . __METHOD__ . " is deprecated since Xoopspoll 1.40, please use XoopspollPollHandler::" . __METHOD__ . " instead.");
        $pollHandler = self::getStaticPollHandler();

        return $pollHandler->updateCount($this->poll->getVar('poll_id'));
    }
    /**
     *
     * inserts the poll object into the database
     * @return mixed results of inserting poll into db
     */
    function store()
    {
        $GLOBALS['xoopsLogger']->addDeprecated(__CLASS__ . "::" . __METHOD__ . " is deprecated since Xoopspoll 1.40, please use XoopspollPollHandler::insert() instead.");
        $pollHandler = self::getStaticPollHandler();

        return $pollHandler->insert($this->poll);
    }
    /**
     *
     * Setup a static Poll Handler for use by class methods
     */
    private function getStaticPollHandler()
    {
        $GLOBALS['xoopsLogger']->addDeprecated(__CLASS__ . "::" . __METHOD__ . " is deprecated since Xoopspoll 1.40, please use XoopspollPoll and XoopspollPollHandler classes instead.");
        static $pH;

        if (!isset($pH)) {
            $pH =& xoops_getmodulehandler('poll', 'xoopspoll');
        }

        return $pH;
    }
/**#@-*/
}

class XoopspollPollHandler extends XoopsPersistableObjectHandler
{
    /**
     * XoopspollPollHandler::__construct()
     *
     * @param mixed $db
    **/
    function __construct(&$db)
    {
        parent::__construct($db, 'mod_xoopspoll_desc', 'XoopspollPoll', 'poll_id', 'question');
    }

    /**
     *
     * Update the Vote count from the log and polls
     * @access public
     * @param  obj  $pollObj
     * @return bool $success
     */
    public function updateCount(&$pollObj)
    {
        $success = false;
        if ($pollObj instanceof XoopspollPoll) {
            $pollId = $pollObj->getVar('poll_id');
            $logHandler =& xoops_getmodulehandler('log', 'xoopspoll');
            $votes  = $logHandler->getTotalVotesByPollId($pollId);
            $voters = $logHandler->getTotalVotersByPollId($pollId);
            $pollObj->setVar('votes', $votes);
            $pollObj->setVar('voters', $voters);
            $success = $this->insert($pollObj);
        }

        return $success;
    }
    /**
     *
     * Mail the results of poll when expired
     * @param  mixed $pollObj
     * @return bool  true|false indicating sendmail status
     */
    public function mailResults($pollObj=null)
    {
        xoops_load('constants', 'xoopspoll');

        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('end_time', time(), '<'));  // expired polls
        $criteria->add(new Criteria('mail_status', XoopspollConstants::POLL_NOT_MAILED, '=')); // email not previously sent
        if (!empty($pollObj) && ($pollObj instanceof XoopspollPoll)) {
            $criteria->add(new Criteria('poll_id', $pollObj->getVar('poll_id'), '='));
            $criteria->setLimit(1);
        }
        $pollObjs = $this->getAll($criteria);
        $tplFile = 'mail_results.tpl';
        if (file_exists($GLOBALS['xoops']->path("modules" . DIRECTORY_SEPARATOR
                                            . "xoopspoll" . DIRECTORY_SEPARATOR
                                             . "language" . DIRECTORY_SEPARATOR
                    . $GLOBALS['xoopsConfig']['language'] . DIRECTORY_SEPARATOR
                                        . "mail_template" . DIRECTORY_SEPARATOR
                                                          . $tplFile)))
        {
            $lang = $GLOBALS['xoopsConfig']['language'];
        } else {
            $lang = 'english';
        }
        xoops_loadLanguage('main', 'xoopspoll', $lang);

        $ret = array();

        // setup mailer
        $xoopsMailer = xoops_getMailer();
        $xoopsMailer->useMail();
        $xoopsMailer->setTemplateDir($GLOBALS['xoops']->path("modules" . DIRECTORY_SEPARATOR
                                                         . "xoopspoll" . DIRECTORY_SEPARATOR
                                                          . "language" . DIRECTORY_SEPARATOR
                                                               . $lang . DIRECTORY_SEPARATOR
                                                     . "mail_template" . DIRECTORY_SEPARATOR)
        );

        $xoopsMailer->setTemplate($tplFile);
        $xoopsMailer->assign('SITENAME', $GLOBALS['xoopsConfig']['sitename']);
        $xoopsMailer->assign('ADMINMAIL', $GLOBALS['xoopsConfig']['adminmail']);
        $xoopsMailer->assign('SITEURL', $GLOBALS['xoops']->url(''));
        $xoopsMailer->assign('MODULEURL', $GLOBALS['xoops']->url("modules/xoopspoll/"));
        $xoopsMailer->setFromEmail($GLOBALS['xoopsConfig']['adminmail']);
        $xoopsMailer->setFromName($GLOBALS['xoopsConfig']['sitename']);
        foreach ($pollObjs as $pollObj) {
            $pollValues = $pollObj->getValues();
            // get author info
            $author = new XoopsUser($pollValues['user_id']);
            if (($author instanceof XoopsUser) && ($author->uid() > 0)) {
                $xoopsMailer->setToUsers($author);
                // initialize variables
                $xoopsMailer->assign('POLL_QUESTION', $pollValues['question']);
                $xoopsMailer->assign('POLL_START', formatTimestamp($pollValues['start_time'], 'l', $author->timezone()));
                $xoopsMailer->assign('POLL_END', formatTimestamp($pollValues['end_time'], 'l', $author->timezone()));
                $xoopsMailer->assign('POLL_VOTES', $pollValues['votes']);
                $xoopsMailer->assign('POLL_VOTERS', $pollValues['voters']);
                $xoopsMailer->assign('POLL_ID', $pollValues['poll_id']);
                $xoopsMailer->setSubject(sprintf(_MD_XOOPSPOLL_YOURPOLLAT,$author->uname(), $GLOBALS['xoopsConfig']['sitename']));
                if (false !== $xoopsMailer->send(false)) {
                    $pollObj->setVar('mail_status', XoopspollConstants::POLL_MAILED);
                    $ret[] = $this->insert($pollObj);
                } else {
                    $ret[] = $xoopsMailer->getErrors(false); // return error array from mailer
                }
            }
        }

        return $ret;
    }
}
