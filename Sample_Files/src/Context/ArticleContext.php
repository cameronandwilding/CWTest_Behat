<?php

/**
 * @file
 * Class ArticleContext implements the behavior for article pages.
 */

namespace CWTest\Context;

use Behat\Gherkin\Node\TableNode;
use CWTest\Exception\CWContextException;
use CWTest\Util\ArticlePage;

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
   *
   * @var ArticlePage
   */
  private $articlePage;

  /**
   * Article page title.
   *
   * @var $string
   */
  private $articlePageTitle;

  /**
   * Article node id.
   *
   * @var $integer
   */
  private $articleNodeId;

  /**
   * ArticleContext constructor.
   */
  public function __construct() {
    parent::__construct();
    $this->articlePage = new ArticlePage();
  }

  /**
   * Fills in the title field.
   *
   * @param string $title
   */
  private function fillTitleField($title) {
    $this->helperContext->iFillInFieldByIDWith($this->articlePage->getField(self::FIELD_TITLE), $title);
    $this->articlePageTitle = $this->helperContext->getSession()
      ->getPage()
      ->findById($this->articlePage->getField(self::FIELD_TITLE))
      ->getValue();
  }

  /**
   * Fills in the body frame.
   *
   * @param string $body
   */
  private function fillBodyFrame($body) {
    $this->helperContext->iFillInFrameWith($this->articlePage->getFrame(self::FIELD_BODY), $body);
  }

  /**
   * Attaches image.
   *
   * @param string $image
   */
  private function attachImage($image) {
    $this->helperContext->minkContext->attachFileToField($this->articlePage->getField(self::FIELD_IMAGE), $image);
    $this->helperContext->waitForJquery();
  }

  /**
   * Fills the alt field.
   *
   * @param string $alt
   */
  private function fillAltField($alt) {
    $this->helperContext->iFillInFieldByDataDrupalSelectorWith($this->articlePage->getHiddenField(self::FIELD_ALT), $alt);
  }

  /**
   * @Given I press save and publish
   */
  public function iPressSaveAndPublish() {
    $this->helperContext->getSession()
      ->getPage()
      ->pressButton($this->articlePage->getCreateButton(self::BUTTON_SAVE_AND_PUBLISH));
  }

  /**
   * @Given I press save and keep published
   */
  public function iPressSaveAndKeepPublished() {
    $this->helperContext->getSession()
      ->getPage()
      ->pressButton($this->articlePage->getEditButton(self::BUTTON_SAVE_AND_KEEP_PUBLISHED));
  }

  /**
   * @Given I complete the Create Article page with generic valid data
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
    $this->helperContext->visitPath($this->articlePage->getPath());
  }

  /**
   * @Given I visit the Edit Article page
   */
  public function visitEditArticlePage() {
    $this->helperContext->visitPath(self::getEditPath());
  }

  /**
   * @Given I visit the Delete Article page
   */
  public function visitDeleteArticlePage() {
    $this->helperContext->visitPath(self::getDeletePath());
  }

  /**
   * @Given I visit the View Article page
   */
  public function visitViewArticlePage() {
    $this->helperContext->visitPath(self::getViewPath());
  }

  /**
   * The /edit path for an Article.
   * @return string
   */
  private function getEditPath() {
    return '/node/' . $this->articleNodeId . '/edit/';
  }

  /**
   * The /delete path for an Article.
   * @return string
   */
  private function getDeletePath() {
    return '/node/' . $this->articleNodeId . '/delete/';
  }

  /**
   * The view path for an Article.
   * @return string
   */
  private function getViewPath() {
    return '/node/' . $this->articleNodeId;
  }

  /**
   * @Given I am still on the Create Article page
   */
  public function iAmStillOnTheCreateArticlePage() {
    $current_url = $this->helperContext->getSession()->getCurrentUrl();
    if (strpos($current_url, $this->articlePage->getPath()) === FALSE) {
      throw new CWContextException("No longer on the Create Article page, but on {$current_url}.");
    }
  }

  /**
   * @Given I am still on the Edit Article page
   */
  public function iAmStillOnTheEditArticlePage() {
    $current_url = $this->helperContext->getSession()->getCurrentUrl();
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
        case self::FIELD_TITLE:
          self::fillTitleField($value);
          break;

        case self::FIELD_BODY:
          self::fillBodyFrame($value);
          break;

        case self::FIELD_IMAGE:
          self::attachImage($value);
          break;

        case self::FIELD_ALT:
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
    self::verifyFields($this->articlePage->getAllFields());
    self::verifyFrames($this->articlePage->getAllFrames());
    self::verifyButtons($this->articlePage->getAllCreateButtons());
  }

  /**
   * @Given I verify the structure of the Edit Article page
   */
  public function iVerifyTheStructureOfTheEditArticlePage() {
    self::verifyFields($this->articlePage->getAllFields());
    self::verifyFrames($this->articlePage->getAllFrames());
    self::verifyButtons($this->articlePage->getAllEditButtons());
    self::verifyLinks($this->articlePage->getAllEditLinks());
  }

  /**
   * @Given I can see the following values on the View Article page
   */
  public function iVerifyTheFollowingValuesOnTheViewArticlePage(TableNode $table) {
    foreach ($table->getHash() as $key => $value) {
      $field = trim($value['FIELD']);
      $value = trim($value['VALUE']);

      if ($field == self::FIELD_TITLE) {
        $this->helperContext->iCanSeeInTheRegion($this->articlePageTitle, $this->articlePage->getRegion('VIEW_TITLE'));
      }
      if ($field == self::FIELD_BODY) {
        $this->helperContext->iCanSeeInTheRegion($value, $this->articlePage->getRegion('VIEW_BODY'));
      }
      if ($field == self::FIELD_IMAGE) {
        $this->helperContext->minkContext->assertElementOnPage($this->articlePage->getRegion('VIEW_IMAGE'));
      }
      if ($field == self::FIELD_ALT) {
        $this->helperContext->iCanSeeTheValueInTheHTML($value);
      }
    }
  }

  /**
   * @Given I delete the article
   */
  public function iDeleteTheArticle() {
    $this->helperContext->getSession()
      ->getPage()
      ->pressButton($this->articlePage->getEditLink('DELETE'));
  }

  /**
   * @Given I verify that the article was created successfully
   */
  public function iVerifyThatTheArticleWasCreatedSuccessfully() {
    $this->helperContext->iCanSeeInTheRegion('Article ' . $this->articlePageTitle . ' has been created.', $this->articlePage->getMessageRegion(self::REGION_SUCCESS_MESSAGE));
    $this->articleNodeId = $this->helperContext->getNodeIDFromEDITLink();
  }

  /**
   * @Given I verify that the article was edited successfully
   */
  public function iVerifyThatTheArticleWasEditedSuccessfully() {
    $this->helperContext->iCanSeeInTheRegion('Article ' . $this->articlePageTitle . ' has been updated.', $this->articlePage->getMessageRegion(self::REGION_SUCCESS_MESSAGE));
  }

  /**
   * @Given I verify that the article was deleted successfully
   */
  public function iVerifyThatTheArticleWasDeletedSuccessfully() {
    $this->helperContext->iCanSeeInTheRegion('The Article ' . $this->articlePageTitle . ' has been deleted.', $this->articlePage->getMessageRegion(self::REGION_SUCCESS_MESSAGE));
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

