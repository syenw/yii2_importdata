<?php

namespace app\controllers;

// require 'vendor/autoload.php';

use Yii;


use PhpOffice\PhpSpreadsheet\Spreadsheet;

use app\models\Book;
use app\models\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
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
     * Lists all Book models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Book model.
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
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Book();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionImport()
    {
        
        // try {
        //     $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        //     // $input_file = 'uploads/book.xlsx';
            
        //     $objPHPExcel = $reader->load($input_file);
        // } catch (Exception $e) {
        //     die('error');
        // }

        // $sheet = $objPHPExcel->getSheet(0);
        // $highestRow = $sheet->getHighestRow();
        // $highestColumn = $sheet->getHighestColumn();
        
        // for ($row = 1; $row < $highestRow; ++$row) { 
        //     $rowData = $sheet ->rangeToArray('A'.$row. ':' .$highestColumn.$row, NULL, TRUE, FALSE);
            
        //     $model = new Book();

        //     $data = array(
        //         'category' => $rowData[0][0],
        //         'title' => $rowData[0][1],
        //         // 'author' => iconv('UTF-8', 'utf-8//IGNORE', $rowData[0][2]),
        //         'author' => $rowData[0][2],
        //         'publisher' => $rowData[0][3],
        //         'code' => $rowData[0][4],
        //         'year' => $rowData[0][5],
        //         'size' => $rowData[0][6],
        //         'page' => $rowData[0][7],
        //         'price' => $rowData[0][8],
        //     );    
        //     $a = Yii::$app->db->createCommand()->insert('books', $data)->execute();
        //     // echo "<pre>";
        //     // print_r($rowData);
        //     // echo "</pre>";
        // }


        // $data = \moonland\phpexcel\Excel::widget([
        //     'mode' => 'import', 
        //     'fileName' => $input_file, 
        //     'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel. 
        //     'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric. 
        //     'getOnlySheet' => 'sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
        // ]);

        // foreach ($data as $key => $value) {
        //     $data = array(
        //         'category' => $value['category'],
        //         'title' => $value['title'],
        //         'author' => $value['author'],
        //         'publisher' => $value['publisher'],
        //         'code' => $value['code'],
        //         'year' => $value['year'],
        //         'size' => $value['size'],
        //         'page' => $value['page'],
        //         'price' => $value['price'],
        //     );    
        //     $a = Yii::$app->db->createCommand()->insert('books', $data)->execute();
        // }
        // if ($a) {
        //     echo 'Success';
        // }
        // else {
        //     echo "Failed";
        // }

    }

    /**
     * Updates an existing Book model.
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
     * Deletes an existing Book model.
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
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
