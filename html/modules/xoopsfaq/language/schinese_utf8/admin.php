<?php
/**
 * Name: admin.php
 * Description: Xoops FAQ module admin language defines
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package : XOOPS
 * @Module : Xoops FAQ
 * @subpackage : Module Language
 * @since 2.3.0
 * @author John Neill
 * @version $Id: admin.php 0000 10/04/2009 09:05:06 John Neill $
 */
defined( 'XOOPS_ROOT_PATH' ) or die( 'Restricted access' );

/**
 * Icons
 */
define( '_XO_LA_EDIT', '编辑条目' );
define( '_XO_LA_DELETE', '删除条目' );
define( '_XO_LA_CREATENEW', '创建条目' );
define( '_XO_LA_MODIFYITEM', '修改条目: %s' );

/**
 * Content
 */
define( '_XO_LA_CONTENTS_HEADER', '帮助中心内容管理' );
define( '_XO_LA_CONTENTS_SUBHEADER', '' );
define( '_XO_LA_CONTENTS_LIST_DSC', '' );
define( '_XO_LA_CONTENTS_ID', '#' );
define( '_XO_LA_CONTENTS_TITLE', '标题' );
define( '_XO_LA_CONTENTS_WEIGHT', '顺序' );
define( '_XO_LA_CONTENTS_PUBLISH', '已发布' );
define( '_XO_LA_CONTENTS_ACTIVE', '启用' );
define( '_XO_LA_ACTIONS', '操作' );
define( '_XO_LAE_CONTENTS_CATEGORY', '类别:' );
define( '_XO_LAE_CONTENTS_CATEGORY_DSC', '请选择条目所属类别' );
define( '_XO_LAE_CONTENTS_TITLE', '标题:' );
define( '_XO_LAE_CONTENTS_TITLE_DSC', '输入此条目的标题.' );
define( '_XO_LAE_CONTENTS_CONTENT', '内容:' );
define( '_XO_LAE_CONTENTS_CONTENT_DSC', '' );
define( '_XO_LAE_CONTENTS_PUBLISH', '发布时间:' );
define( '_XO_LAE_CONTENTS_PUBLISH_DSC', '选择条目的发布时间' );
define( '_XO_LAE_CONTENTS_WEIGHT', '条目顺序:' );
define( '_XO_LAE_CONTENTS_WEIGHT_DSC', '输入一个有效数字 ' );
define( '_XO_LAE_CONTENTS_ACTIVE', '启用这个项目:' );
define( '_XO_LAE_CONTENTS_AVTIVE_DSC', '选择是否在前台显示这个条目' );
define( '_XO_LAE_DOHTML', '以HTML格式显示' );
define( '_XO_LAE_BREAKS', '转换Linebreaks为Xoopskreaks' );
define( '_XO_LAE_DOIMAGE', '显示Xoops图片' );
define( '_XO_LAE_DOXCODE', '显示Xoops代码' );
define( '_XO_LAE_DOSMILEY', '显示Xoops表情' );

/**
 * Category
 */
define( '_XO_LA_ADDCAT', '增加分类' );
define( '_XO_LA_CATEGORY_HEADER', '帮助中心分类管理' );
define( '_XO_LA_CATEGORY_SUBHEADER', '' );
define( '_XO_LA_CATEGORY_DELETE_DSC', 'Delete Check! You are about to delete this item. You can cancel this action by clicking on the cancel button or you can choose to continue.<br /><br />This action is not reversible.' );
define( '_XO_LA_CATEGORY_EDIT_DSC', '编辑模式: You can edit this item properties here. Click the submit button to make your changes permanent or click Cancel to return you were you where.' );
define( '_XO_LA_CATEGORY_LIST_DSC', '' );
define( '_XO_LA_CATEGORY_ID', '#' );
define( '_XO_LA_CATEGORY_TITLE', '标题' );
define( '_XO_LA_CATEGORY_WEIGHT', '权重' );
define( '_XO_LA_ACTIONS', '操作' );
define( '_XO_LAE_CATEGORY_TITLE', '类别标题:' );
define( '_XO_LAE_CATEGORY_TITLE_DSC', '' );
define( '_XO_LAE_CATEGORY_WEIGHT', '类别顺序:' );
define( '_XO_LAE_CATEGORY_WEIGHT_DSC', '' );

/**
 * Buttons
 */
define( '_XO_LA_CREATENEW', '新建' );
define( '_XO_LA_NOLISTING', '没有找到任何条目' );

/**
 * Database and error
 */
define( '_XO_LA_FAQ_SUBERROR', '发生了一个错误<br />' );
define( '_XO_LA_RUSURECAT', '你确定要删除这个类别和里面所有的问答吗？' );
define( '_XO_LA_DBSUCCESS', '数据库更新成功!' );
define( '_XO_LA_ERRORNOCATEGORY', '错误: 没有选择任何分类，请返回选择一个分类' );
define( '_XO_LA_ERRORCOULDNOTADDCAT', '错误: 无法增加分类.' );
define( '_XO_LA_ERRORCOULDNOTDELCAT', '错误: 无法删除分类.' );
define( '_XO_LA_ERRORCOULDNOTEDITCAT', '错误: 无法编辑条目.' );
define( '_XO_LA_ERRORCOULDNOTDELCONTENTS', '错误: 无法删除FAQ内容.' );
define( '_XO_LA_ERRORCOULDNOTUPCONTENTS', '错误: 无法更新FAQ内容' );
define( '_XO_LA_ERRORCOULDNOTADDCONTENTS', '错误: 无法增加FAQ条目.' );
define( '_XO_LA_NOTHTINGTOSHOW', '没有条目' );
define( '_XO_LA_ERRORNOCAT', '错误: 现在还没有类别。请先创建一个类别' );

?>