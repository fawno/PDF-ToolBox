<?php
	declare(strict_types=1);

	namespace PDFToolBox\Controller;

	use App\Controller\AppController as BaseController;
	use Cake\Event\EventInterface;
	use Fawno\FPDF\FawnoFPDF;
	use PDFToolBox\View\AppView;
	use setasign\Fpdi\PdfReader\PageBoundaries;

	class AppController extends BaseController {
		public function beforeFilter (EventInterface $event) {
			parent::beforeFilter($event);
		}

		public function initialize () : void {
			parent::initialize();

			$this->viewBuilder()->setClassName(AppView::class);
		}

		public function index () {
		}

		public function crop () {
			if ($this->request->is('post')) {
				$file = $this->request->getUploadedFile('pdf');
				$media_type = $file->getClientMediaType();

				if (!in_array($media_type, ['application/pdf'])) {
					return;
				}

				$path = $file->getStream()->getMetadata('uri');

				$pdf = new FawnoFPDF();

				$pages = $pdf->setSourceFile($path);
				for ($page = 1; $page <= $pages; $page++) {
					$page_id = $pdf->importPage($page, PageBoundaries::TRIM_BOX);
					$size = $pdf->getImportedPageSize($page_id);
					$pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
					$pdf->useTemplate($page_id);
				}

				$filename = pathinfo($file->getClientFilename(), PATHINFO_FILENAME) . '-cropped.pdf';

				$response = $this->response;
				$response = $response->withDisabledCache();
				$response = $response->withStringBody($pdf->Output('S'));
				$response = $response->withType($media_type);
				$response = $response->withDownload($filename);
				return $response;

				$this->set(compact('file'));
			}
		}
	}
