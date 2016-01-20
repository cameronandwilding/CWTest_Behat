<?php

use Behat\Gherkin\Node\TableNode;

class ArticleContext extends PageContext {

  /**
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
  private function fill_title_field($title) {
    $this->helper_context->iFillInFieldByIDWith($this->article_page->get_field('TITLE'), $title);
    $this->article_page_title = $this->helper_context->getSession()
      ->getPage()
      ->findById($this->article_page->get_field('TITLE'))
      ->getValue();
  }

  /**
   * @param string $body
   */
  private function fill_body_frame($body) {
    $this->helper_context->iFillInFrameWith($this->article_page->get_frame('BODY'), $body);
  }

  /**
   * @param string $image
   */
  private function attach_image($image) {
    $this->helper_context->minkContext->attachFileToField($this->article_page->get_field('IMAGE'), $image);
    $this->helper_context->waitForJquery();
  }

  /**
   * @param string $alt
   */
  private function fill_alt_field($alt) {
    $this->helper_context->iFillInFieldByDataDrupalSelectorWith($this->article_page->get_hidden_field('ALT'), $alt);
  }

  /**
   * @Given I press save and publish
   */
  public function i_press_save_and_publish() {
    $this->helper_context->getSession()
      ->getPage()
      ->pressButton($this->article_page->get_create_button('SAVE_AND_PUBLISH'));
  }

  /**
   * @Given I press save and keep published
   */
  public function i_press_save_and_keep_published() {
    $this->helper_context->getSession()
      ->getPage()
      ->pressButton($this->article_page->get_edit_button('SAVE_AND_KEEP_PUBLISHED'));
  }

  /**
   * @Given I complete the Create Article page with generic valid data
   *
   * @param string $username , $password
   */
  public function fill_in_article_content_with_generic_valid_data() {
    self::fill_title_field('Article Title <alpha>');
    self::fill_body_frame('This is the body text of the Article.');
    self::attach_image('150x350.jpg');
    self::fill_alt_field('This is some ALT text');
  }

  /**
   * @Given I visit the Create Article page
   */
  public function visit_create_article_page() {
    $this->helper_context->visitPath($this->article_page->get_path());
  }

  /**
   * @Given I visit the Edit Article page
   */
  public function visit_edit_article_page() {
    $this->helper_context->visitPath(self::get_edit_path());
  }

  /**
   * @Given I visit the Delete Article page
   */
  public function visit_delete_article_page() {
    $this->helper_context->visitPath(self::get_delete_path());
  }

  /**
   * @Given I visit the View Article page
   */
  public function visit_view_article_page() {
    $this->helper_context->visitPath(self::get_view_path());
  }

  /**
   * The /edit path for an Article.
   * @return string
   */
  private function get_edit_path() {
    return '/node/' . $this->article_node_id . '/edit/';
  }

  /**
   * The /delete path for an Article.
   * @return string
   */
  private function get_delete_path() {
    return '/node/' . $this->article_node_id . '/delete/';
  }

  /**
   * The view path for an Article.
   * @return string
   */
  private function get_view_path() {
    return '/node/' . $this->article_node_id;
  }

  /**
   * @Given I am still on the Create Article page
   */
  public function i_am_still_on_the_create_article_page() {
    $current_url = $this->helper_context->getSession()->getCurrentUrl();
    if (strpos($current_url, $this->article_page->get_path()) === FALSE) {
      throw new CWContextException("No longer on the Create Article page, but on {$current_url}.");
    }
  }

  /**
   * @Given I am still on the Edit Article page
   */
  public function i_am_still_on_the_edit_article_page() {
    $current_url = $this->helper_context->getSession()->getCurrentUrl();
    if (strpos($current_url, self::get_edit_path()) === FALSE) {
      throw new CWContextException("No longer on the Edit Article page, but on {$current_url}.");
    }
  }

  /**
   * @Given I enter the following values on the Create Article page
   * @Given I enter the following values on the Edit Article page
   */
  public function i_enter_the_following_values_on_the_create_edit_article_page(TableNode $table) {
    foreach ($table->getHash() as $key => $value) {
      $field = trim($value['FIELD']);
      $value = trim($value['VALUE']);

      switch ($field) {
        case 'TITLE':
          self::fill_title_field($value);
          break;
        case 'BODY':
          self::fill_body_frame($value);
          break;
        case 'IMAGE':
          self::attach_image($value);
          break;
        case 'ALT':
          self::fill_alt_field($value);
          break;
        default:
          throw new CWContextException("The field {$field} does not exist on this page.");
      }
    }
  }

  /**
   * @Given I verify the structure of the Create Article page
   */
  public function i_verify_the_structure_of_the_create_article_page() {
    self::verify_fields($this->article_page->get_all_fields());
    self::verify_frames($this->article_page->get_all_frames());
    self::verify_buttons($this->article_page->get_all_create_buttons());
  }

  /**
   * @Given I verify the structure of the Edit Article page
   */
  public function i_verify_the_structure_of_the_edit_article_page() {
    self::verify_fields($this->article_page->get_all_fields());
    self::verify_frames($this->article_page->get_all_frames());
    self::verify_buttons($this->article_page->get_all_edit_buttons());
    self::verify_links($this->article_page->get_all_edit_links());
  }

  /**
   * @Given I can see the following values on the View Article page
   */
  public function i_verify_the_following_values_on_the_view_article_page(TableNode $table) {
    foreach ($table->getHash() as $key => $value) {
      $field = trim($value['FIELD']);
      $value = trim($value['VALUE']);

      if ($field == 'TITLE') {
        $this->helper_context->iCanSeeInTheRegion($this->article_page_title, $this->article_page->get_region('VIEW_TITLE'));
      }
      if ($field == 'BODY') {
        $this->helper_context->iCanSeeInTheRegion($value, $this->article_page->get_region('VIEW_BODY'));
      }
      if ($field == 'IMAGE') {
        $this->helper_context->minkContext->assertElementOnPage($this->article_page->get_region('VIEW_IMAGE'));
      }
      if ($field == 'ALT') {
        $this->helper_context->iCanSeeTheValueInTheHTML($value);
      }
    }
  }

  /**
   * @Given I delete the article
   */
  public function i_delete_the_article() {
    $this->helper_context->getSession()
      ->getPage()
      ->pressButton($this->article_page->get_edit_link('DELETE'));
  }

  /**
   * @Given I verify that the article was created successfully
   */
  public function i_verify_that_the_article_was_created_successfully() {
    $this->helper_context->iCanSeeInTheRegion('Article ' . $this->article_page_title . ' has been created.', $this->article_page->get_message_region('SUCCESS_MESSAGE_REGION'));
    $this->article_node_id = $this->helper_context->getNodeIDFromEDITLink();
  }

  /**
   * @Given I verify that the article was edited successfully
   */
  public function i_verify_that_the_article_was_edited_successfully() {
    $this->helper_context->iCanSeeInTheRegion('Article ' . $this->article_page_title . ' has been updated.', $this->article_page->get_message_region('SUCCESS_MESSAGE_REGION'));
  }

  /**
   * @Given I verify that the article was deleted successfully
   */
  public function i_verify_that_the_article_was_deleted_successfully() {
    $this->helper_context->iCanSeeInTheRegion('The Article ' . $this->article_page_title . ' has been deleted.', $this->article_page->get_message_region('SUCCESS_MESSAGE_REGION'));
  }

  /**
   * @Given I verify the header
   */
  public function i_verify_the_header() {
    self::verify_header();
  }

  /**
   * @Given I verify the footer
   */
  public function i_verify_the_footer() {
    self::verify_footer();
  }
}

