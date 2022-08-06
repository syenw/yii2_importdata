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
        $model = new Document();
        $model2 = new Book();

        if ($this->request->isPost) {
            $file = UploadedFile::getInstance($model, 'name');

            try {
                if ($model->validate()) {
                    $file->saveAs('uploads/'.$file->name);
                    $model->name = $file->name;
                    $model->size = $file->size;

                    if ($model->save()) {
                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                        $objPHPExcel = $reader->load("uploads/$file->name");

                        $sheet = $objPHPExcel->getSheet(0);
                        $highestRow = $sheet->getHighestRow();
                        $highestColumn = $sheet->getHighestColumn();

                        for ($row = 1; $row < $highestRow; ++$row) { 
                            $rowData = $sheet ->rangeToArray('A'.$row. ':' .$highestColumn.$row, NULL, TRUE, FALSE);
                            $data = array(
                                'category' => $rowData[0][0],
                                'title' => $rowData[0][1],
                                // 'author' => iconv('UTF-8', 'utf-8//IGNORE', $rowData[0][2]),
                                'author' => $rowData[0][2],
                                'publisher' => $rowData[0][3],
                                'code' => $rowData[0][4],
                                'year' => $rowData[0][5],
                                'size' => $rowData[0][6],
                                'page' => $rowData[0][7],
                                'price' => $rowData[0][8],
                            );
                            Yii::$app->db->createCommand()->insert('books', $data)->execute();
                        }   
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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
