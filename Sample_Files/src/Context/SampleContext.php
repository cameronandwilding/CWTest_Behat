<?php

/**
 * @file
 * Class SampleContext implements the behavior for sample pages.
 */

namespace CWTest\Context;

use Behat\Gherkin\Node\TableNode;
use CWTest\Exception\CWContextException;
use CWTest\Util\SamplePage;

class SampleContext extends PageContext {

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
   * SamplePage instance.
   *
   * @var SamplePage
   */
  private $samplePage;

  /**
   * Sample page title.
   *
   * @var $string
   */
  private $samplePageTitle;

  /**
   * Sample node id.
   *
   * @var $integer
   */
  private $sampleNodeId;

  /**
   * SampleContext constructor.
   */
  public function __construct() {
    parent::__construct();
    $this->samplePage = new SamplePage();
  }

  /**
   * Fills in the title field.
   *
   * @param string $title
   */
  private function fillTitleField($title) {
    $this->helperContext->iFillInFieldByIDWith($this->samplePage->getField(self::FIELD_TITLE), $title);
    $this->samplePageTitle = $this->helperContext->getSession()
      ->getPage()
      ->findById($this->samplePage->getField(self::FIELD_TITLE))
      ->getValue();
  }

  /**
   * Fills in the body frame.
   *
   * @param string $body
   */
  private function fillBodyFrame($body) {
    $this->helperContext->iFillInFrameWith($this->samplePage->getFrame(self::FIELD_BODY), $body);
  }

  /**
   * Attaches image.
   *
   * @param string $image
   */
  private function attachImage($image) {
    $this->helperContext->minkContext->attachFileToField($this->samplePage->getField(self::FIELD_IMAGE), $image);
    $this->helperContext->waitForJquery();
  }

  /**
   * Fills the alt field.
   *
   * @param string $alt
   */
  private function fillAltField($alt) {
    $this->helperContext->iFillInFieldByDataDrupalSelectorWith($this->samplePage->getHiddenField(self::FIELD_ALT), $alt);
  }

  /**
   * @Given I press save and publish
   */
  public function iPressSaveAndPublish() {
    $this->helperContext->getSession()
      ->getPage()
      ->pressButton($this->samplePage->getCreateButton(self::BUTTON_SAVE_AND_PUBLISH));
  }

  /**
   * @Given I press save and keep published
   */
  public function iPressSaveAndKeepPublished() {
    $this->helperContext->getSession()
      ->getPage()
      ->pressButton($this->samplePage->getEditButton(self::BUTTON_SAVE_AND_KEEP_PUBLISHED));
  }

  /**
   * @Given I complete the Create Sample page with generic valid data
   */
  public function fillInSampleContentWithGenericValidData() {
    self::fillTitleField('Sample Title <alpha>');
    self::fillBodyFrame('This is the body text of the Sample.');
    self::attachImage('150x350.jpg');
    self::fillAltField('This is some ALT text');
  }

  /**
   * @Given I visit the Create Sample page
   */
  public function visitCreateSamplePage() {
    $this->helperContext->visitPath($this->samplePage->getPath());
  }

  /**
   * @Given I visit the Edit Sample page
   */
  public function visitEditSamplePage() {
    $this->helperContext->visitPath(self::getEditPath());
  }

  /**
   * @Given I visit the Delete Sample page
   */
  public function visitDeleteSamplePage() {
    $this->helperContext->visitPath(self::getDeletePath());
  }

  /**
   * @Given I visit the View Sample page
   */
  public function visitViewSamplePage() {
    $this->helperContext->visitPath(self::getViewPath());
  }

  /**
   * The /edit path for an Sample.
   * @return string
   */
  private function getEditPath() {
    return '/node/' . $this->sampleNodeId . '/edit/';
  }

  /**
   * The /delete path for an Sample.
   * @return string
   */
  private function getDeletePath() {
    return '/node/' . $this->sampleNodeId . '/delete/';
  }

  /**
   * The view path for an Sample.
   * @return string
   */
  private function getViewPath() {
    return '/node/' . $this->sampleNodeId;
  }

  /**
   * @Given I am still on the Create Sample page
   */
  public function iAmStillOnTheCreateSamplePage() {
    $current_url = $this->helperContext->getSession()->getCurrentUrl();
    if (strpos($current_url, $this->samplePage->getPath()) === FALSE) {
      throw new CWContextException("No longer on the Create Sample page, but on {$current_url}.");
    }
  }

  /**
   * @Given I am still on the Edit Sample page
   */
  public function iAmStillOnTheEditSamplePage() {
    $current_url = $this->helperContext->getSession()->getCurrentUrl();
    if (strpos($current_url, self::getEditPath()) === FALSE) {
      throw new CWContextException("No longer on the Edit Sample page, but on {$current_url}.");
    }
  }

  /**
   * @Given I enter the following values on the Create Sample page
   * @Given I enter the following values on the Edit Sample page
   */
  public function iEnterTheFollowingValuesOnTheCreateEditSamplePage(TableNode $table) {
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
   * @Given I verify the structure of the Create Sample page
   */
  public function iVerifyTheStructureOfTheCreateSamplePage() {
    self::verifyFields($this->samplePage->getAllFields());
    self::verifyFrames($this->samplePage->getAllFrames());
    self::verifyButtons($this->samplePage->getAllCreateButtons());
  }

  /**
   * @Given I verify the structure of the Edit Sample page
   */
  public function iVerifyTheStructureOfTheEditSamplePage() {
    self::verifyFields($this->samplePage->getAllFields());
    self::verifyFrames($this->samplePage->getAllFrames());
    self::verifyButtons($this->samplePage->getAllEditButtons());
    self::verifyLinks($this->samplePage->getAllEditLinks());
  }

  /**
   * @Given I can see the following values on the View Sample page
   */
  public function iVerifyTheFollowingValuesOnTheViewSamplePage(TableNode $table) {
    foreach ($table->getHash() as $key => $value) {
      $field = trim($value['FIELD']);
      $value = trim($value['VALUE']);

      if ($field == self::FIELD_TITLE) {
        $this->helperContext->iCanSeeInTheRegion($this->samplePageTitle, $this->samplePage->getRegion('VIEW_TITLE'));
      }
      if ($field == self::FIELD_BODY) {
        $this->helperContext->iCanSeeInTheRegion($value, $this->samplePage->getRegion('VIEW_BODY'));
      }
      if ($field == self::FIELD_IMAGE) {
        $this->helperContext->minkContext->assertElementOnPage($this->samplePage->getRegion('VIEW_IMAGE'));
      }
      if ($field == self::FIELD_ALT) {
        $this->helperContext->iCanSeeTheValueInTheHTML($value);
      }
    }
  }

  /**
   * @Given I delete the sample
   */
  public function iDeleteTheSample() {
    $this->helperContext->getSession()
      ->getPage()
      ->pressButton($this->samplePage->getEditLink('DELETE'));
  }

  /**
   * @Given I verify that the sample was created successfully
   */
  public function iVerifyThatTheSampleWasCreatedSuccessfully() {
    $this->helperContext->iCanSeeInTheRegion('Sample ' . $this->samplePageTitle . ' has been created.', $this->samplePage->getMessageRegion(self::REGION_SUCCESS_MESSAGE));
    $this->sampleNodeId = $this->helperContext->getNodeIDFromEDITLink();
  }

  /**
   * @Given I verify that the sample was edited successfully
   */
  public function iVerifyThatTheSampleWasEditedSuccessfully() {
    $this->helperContext->iCanSeeInTheRegion('Sample ' . $this->samplePageTitle . ' has been updated.', $this->samplePage->getMessageRegion(self::REGION_SUCCESS_MESSAGE));
  }

  /**
   * @Given I verify that the sample was deleted successfully
   */
  public function iVerifyThatTheSampleWasDeletedSuccessfully() {
    $this->helperContext->iCanSeeInTheRegion('The Sample ' . $this->samplePageTitle . ' has been deleted.', $this->samplePage->getMessageRegion(self::REGION_SUCCESS_MESSAGE));
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

