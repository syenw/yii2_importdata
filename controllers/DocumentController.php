<?php

namespace app\controllers;

use Yii;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use app\models\Book;
use app\models\Document;
use app\models\DocumentSearch;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocumentController implements the CRUD actions for Document model.
 */
class DocumentController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Document models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Document model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Document model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        // 
        $model = new Document();
        $model2 = new Book();

        // 
        $folder = Yii::$app->basePath . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'uploads';

        // 
        if ($this->request->isPost) {
            // 
            $file = UploadedFile::getInstance($model, 'name');

            // 
            if (!file_exists($folder)) {
                mkdir('uploads', 0777, true);
            }

            try {
                // 
                if ($model->validate()) {
                    // 
                    $file->saveAs('uploads/'.$file->name);
                    
                    // 
                    $model->name = $file->name;
                    
                    // 
                    $model->size = $file->size;

                    if ($model->save()) {
                        // 
                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                        
                        // 
                        $objPHPExcel = $reader->load("uploads/$file->name");

                        // 
                        $sheet = $objPHPExcel->getSheet(0);
                        
                        // 
                        $highestRow = $sheet->getHighestRow();
                        
                        // 
                        $highestColumn = $sheet->getHighestColumn();

                        
                        // 
                        for ($row = 1; $row <= $highestRow; ++$row) { 
                            // 
                            $rowData = $sheet ->rangeToArray('A'.$row. ':' .$highestColumn.$row, NULL, TRUE, FALSE);

                            // 
                            $data = array(
                                'code' => $rowData[0][0],
                                'category' => $rowData[0][1],
                                'isbn' => $rowData[0][2],
                                'title' => $rowData[0][3],
                                'author' => $rowData[0][4],
                                'publisher' => $rowData[0][5],
                                'year' => $rowData[0][6],
                            );

                            Yii::$app->db->createCommand()->insert('books', $data)->execute();
                        } 
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                    else {
                        throw new Exception("Error Processing Request");
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage();   
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Document model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model2 = new Book();

        if ($this->request->isPost) {
            // 
            $file = UploadedFile::getInstance($model, 'name');
            
            try {
                // 
                if ($model->validate()) {
                    // 
                    $file->saveAs('uploads/'.$file->name);
                    
                    // 
                    $model->name = $file->name;
                    
                    // 
                    $model->size = $file->size;

                    if ($model->save()) {
                        // 
                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                        
                        // 
                        $objPHPExcel = $reader->load("uploads/$file->name");

                        // 
                        $sheet = $objPHPExcel->getSheet(0);
                        
                        // 
                        $highestRow = $sheet->getHighestRow();
                        
                        // 
                        $highestColumn = $sheet->getHighestColumn();

                        
                        // 
                        for ($row = 1; $row <= $highestRow; ++$row) { 
                            // 
                            $rowData = $sheet ->rangeToArray('A'.$row. ':' .$highestColumn.$row, NULL, TRUE, FALSE);

                            // 
                            $data = array(
                                'code' => $rowData[0][0],
                                'category' => $rowData[0][1],
                                'isbn' => $rowData[0][2],
                                'title' => $rowData[0][3],
                                'author' => $rowData[0][4],
                                'publisher' => $rowData[0][5],
                                'year' => $rowData[0][6],
                            );

                            Yii::$app->db->createCommand()->update('books', $data)->execute();
                        } 
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                    else {
                        throw new Exception("Error Processing Request");
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage();   
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Document model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Document model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Document the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Document::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
