<?php

/**
 *@file
 * Class ArticleContext implements the behavior for article pages.
 */

use Behat\Gherkin\Node\TableNode;

class ArticleContext extends PageContext {

  //  Fields.
  const FIELD_TITLE = 'TITLE';
  const FIELD_BODY = 'BODY';
  const FIELD_IMAGE = 'IMAGE';
  const FIELD_ALT = 'ALT';

  // Buttons.
  const BUTTON_SAVE_AND_PUBLISH = 'SAVE_AND_PUBLISH';
  const BUTTON_SAVE_AND_KEEP_PUBLISHED = 'SAVE_AND_KEEP_PUBLISHED';

  //  Regions.
  const REGION_SUCCESS_MESSAGE = 'SUCCESS_MESSAGE_REGION';

  /**
   * ArticlePage instance.
   * @var ArticlePage
   */
  private $article_page;

  /**
   * @var $string
   */
  private $article_page_title;

  /**
   * @var $integer
   */
  private $article_node_id;

  /**
   * ArticleContext constructor.
   */
  public function __construct() {
    parent::__construct();
    $this->article_page = new ArticlePage();
  }

  /**
   * @param string $title
   */
  private function fillTitleField($title) {
    $this->helper_context->iFillInFieldByIDWith($this->article_page->getField(self::FIELD_TITLE), $title);
    $this->article_page_title = $this->helper_context->getSession()
      ->getPage()
      ->findById($this->article_page->getField('TITLE'))
      ->getValue();
  }

  /**
   * @param string $body
   */
  private function fillBodyFrame($body) {
    $this->helper_context->iFillInFrameWith($this->article_page->getFrame(self::FIELD_BODY), $body);
  }

  /**
   * @param string $image
   */
  private function attachImage($image) {
    $this->helper_context->minkContext->attachFileToField($this->article_page->getField(self::FIELD_IMAGE), $image);
    $this->helper_context->waitForJquery();
  }

  /**
   * @param string $alt
   */
  private function fillAltField($alt) {
    $this->helper_context->iFillInFieldByDataDrupalSelectorWith($this->article_page->getHiddenField(self::FIELD_ALT), $alt);
  }

  /**
   * @Given I press save and publish
   */
  public function iPressSaveAndPublish() {
    $this->helper_context->getSession()
      ->getPage()
      ->pressButton($this->article_page->getCreateButton(self::BUTTON_SAVE_AND_PUBLISH));
  }

  /**
   * @Given I press save and keep published
   */
  public function iPressSaveAndKeepPublished() {
    $this->helper_context->getSession()
      ->getPage()
      ->pressButton($this->article_page->getEditButton('SAVE_AND_KEEP_PUBLISHED'));
  }

  /**
   * @Given I complete the Create Article page with generic valid data
   *
   * @param string $username , $password
   */
  public function fillInArticleContentWithGenericValidData() {
    self::fillTitleField('Article Title <alpha>');
    self::fillBodyFrame('This is the body text of the Article.');
    self::attachImage('150x350.jpg');
    self::fillAltField('This is some ALT text');
  }

  /**
   * @Given I visit the Create Article page
   */
  public function visitCreateArticlePage() {
    $this->helper_context->visitPath($this->article_page->getPath());
  }

  /**
   * @Given I visit the Edit Article page
   */
  public function visitEditArticlePage() {
    $this->helper_context->visitPath(self::getEditPath());
  }

  /**
   * @Given I visit the Delete Article page
   */
  public function visitDeleteArticlePage() {
    $this->helper_context->visitPath(self::getDeletePath());
  }

  /**
   * @Given I visit the View Article page
   */
  public function visitViewArticlePage() {
    $this->helper_context->visitPath(self::getViewPath());
  }

  /**
   * The /edit path for an Article.
   * @return string
   */
  private function getEditPath() {
    return '/node/' . $this->article_node_id . '/edit/';
  }

  /**
   * The /delete path for an Article.
   * @return string
   */
  private function getDeletePath() {
    return '/node/' . $this->article_node_id . '/delete/';
  }

  /**
   * The view path for an Article.
   * @return string
   */
  private function getViewPath() {
    return '/node/' . $this->article_node_id;
  }

  /**
   * @Given I am still on the Create Article page
   */
  public function iAmStillOnTheCreateArticlePage() {
    $current_url = $this->helper_context->getSession()->getCurrentUrl();
    if (strpos($current_url, $this->article_page->getPath()) === FALSE) {
      throw new CWContextException("No longer on the Create Article page, but on {$current_url}.");
    }
  }

  /**
   * @Given I am still on the Edit Article page
   */
  public function iAmStillOnTheEditArticlePage() {
    $current_url = $this->helper_context->getSession()->getCurrentUrl();
    if (strpos($current_url, self::getEditPath()) === FALSE) {
      throw new CWContextException("No longer on the Edit Article page, but on {$current_url}.");
    }
  }

  /**
   * @Given I enter the following values on the Create Article page
   * @Given I enter the following values on the Edit Article page
   */
  public function iEnterTheFollowingValuesOnTheCreateEditArticlePage(TableNode $table) {
    foreach ($table->getHash() as $key => $value) {
      $field = trim($value['FIELD']);
      $value = trim($value['VALUE']);

      switch ($field) {
        case 'TITLE':
          self::fillTitleField($value);
          break;
        case 'BODY':
          self::fillBodyFrame($value);
          break;
        case 'IMAGE':
          self::attachImage($value);
          break;
        case 'ALT':
          self::fillAltField($value);
          break;
        default:
          throw new CWContextException("The field {$field} does not exist on this page.");
      }
    }
  }

  /**
   * @Given I verify the structure of the Create Article page
   */
  public function iVerifyTheStructureOfTheCreateArticlePage() {
    self::verifyFields($this->article_page->getAllFields());
    self::verifyFrames($this->article_page->getAllFrames());
    self::verifyButtons($this->article_page->getAllCreateButtons());
  }

  /**
   * @Given I verify the structure of the Edit Article page
   */
  public function iVerifyTheStructureOfTheEditArticlePage() {
    self::verifyFields($this->article_page->getAllFields());
    self::verifyFrames($this->article_page->getAllFrames());
    self::verifyButtons($this->article_page->getAllEditButtons());
    self::verifyLinks($this->article_page->getAllEditLinks());
  }

  /**
   * @Given I can see the following values on the View Article page
   */
  public function iVerifyTheFollowingValuesOnTheViewArticlePage(TableNode $table) {
    foreach ($table->getHash() as $key => $value) {
      $field = trim($value['FIELD']);
      $value = trim($value['VALUE']);

      if ($field == 'TITLE') {
        $this->helper_context->iCanSeeInTheRegion($this->article_page_title, $this->article_page->getRegion('VIEW_TITLE'));
      }
      if ($field == 'BODY') {
        $this->helper_context->iCanSeeInTheRegion($value, $this->article_page->getRegion('VIEW_BODY'));
      }
      if ($field == 'IMAGE') {
        $this->helper_context->minkContext->assertElementOnPage($this->article_page->getRegion('VIEW_IMAGE'));
      }
      if ($field == 'ALT') {
        $this->helper_context->iCanSeeTheValueInTheHTML($value);
      }
    }
  }

  /**
   * @Given I delete the article
   */
  public function iDeleteTheArticle() {
    $this->helper_context->getSession()
      ->getPage()
      ->pressButton($this->article_page->getEditLink('DELETE'));
  }

  /**
   * @Given I verify that the article was created successfully
   */
  public function iVerifyThatTheArticleWasCreatedSuccessfully() {
    $this->helper_context->iCanSeeInTheRegion('Article ' . $this->article_page_title . ' has been created.', $this->article_page->getMessageRegion(self::REGION_SUCCESS_MESSAGE));
    $this->article_node_id = $this->helper_context->getNodeIDFromEDITLink();
  }

  /**
   * @Given I verify that the article was edited successfully
   */
  public function iVerifyThatTheArticleWasEditedSuccessfully() {
    $this->helper_context->iCanSeeInTheRegion('Article ' . $this->article_page_title . ' has been updated.', $this->article_page->getMessageRegion(self::REGION_SUCCESS_MESSAGE));
  }

  /**
   * @Given I verify that the article was deleted successfully
   */
  public function iVerifyThatTheArticleWasDeletedSuccessfully() {
    $this->helper_context->iCanSeeInTheRegion('The Article ' . $this->article_page_title . ' has been deleted.', $this->article_page->getMessageRegion(self::REGION_SUCCESS_MESSAGE));
  }

  /**
   * @Given I verify the header
   */
  public function iVerifyTheHeader() {
    self::verifyHeader();
  }

  /**
   * @Given I verify the footer
   */
  public function iVerifyTheFooter() {
    self::verifyFooter();
  }
}

