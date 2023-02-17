<?php
/**
 * @file
 * Contains \Drupal\csvupload\Form\ImportForm.
 */
namespace Drupal\csvupload\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
use Drupal\file\Entity\File;

class ImportForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'example_import_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['description'] = array(
      '#markup' => '<p>Use this form to upload a CSV file of Data</p>',
    );

    $form['import_csv'] = array(
      '#type' => 'managed_file',
      '#title' => t('Upload file here'),
      '#upload_location' => 'public://importcsv/',
      '#default_value' => '',
      "#upload_validators"  => array("file_validate_extensions" => array("csv")),
      '#states' => array(
        'visible' => array(
          ':input[name="File_type"]' => array('value' => t('Upload Your File')),
        ),
      ),
    );

    $form['actions']['#type'] = 'actions';


    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Upload CSV'),
      '#button_type' => 'primary',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {


    /* Fetch the array of the file stored temporarily in database */
    $csv_file = $form_state->getValue('import_csv');

    /* Load the object of the file by it's fid */
    $file = File::load( $csv_file[0] );

    /* Set the status flag permanent of the file object */
    $file->setPermanent();

    /* Save the file in database */
    $file->save();

    // You can use any sort of function to process your data. The goal is to get each 'row' of data into an array


        // Get all data to be processed.
 
        // $all_nids = \Drupal::entityQuery('node')
        //                       ->condition('type', 'collegeinfo')
        //                       ->execute();
 
        // // Breakdown your process into small batches(operations).
        // //      Delete 50 nodes per batch.
        // $operations = [];
        // foreach (array_chunk($all_nids, 20) as $smaller_batch_data) {
        //     $operations[] = ['\Drupal\tradesteps\Form\BatchDeleteForm::batchDelete'
        //                                     , [$smaller_batch_data]];
        // }




    $data = $this->csvtoarray($file->getFileUri(), ',');
    // dd($data);
    foreach(array_chunk($data,20) as $row) {
      //  dd($row);
      $operations[] = ['\Drupal\csvupload\addImportContent::addImportContentItem', [$row]];
    }

    $batch = array(
      'title' => t('Importing Data...'),
      'operations' => $operations,
      'init_message' => t('Import is starting.'),
      'finished' => '\Drupal\csvupload\addImportContent::addImportContentItemCallback',
    );
    batch_set($batch);
  }

  public function csvtoarray($filename='', $delimiter){

    if(!file_exists($filename) || !is_readable($filename)) return FALSE;
    $header = NULL;
    $data = array();

    if (($handle = fopen($filename, 'r')) !== FALSE ) {
      while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
      {
        if(!$header){
          $header = $row;
        }else{
          $data[] = array_combine($header, $row);
        }
      }
      fclose($handle);
    }

    return $data;
  }

}