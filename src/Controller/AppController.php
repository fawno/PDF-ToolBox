<?php
	declare(strict_types=1);

	namespace PDFToolBox\Controller;

	use App\Controller\AppController as BaseController;
	use Cake\Event\EventInterface;
	use Fawno\FPDF\FawnoFPDF;
	use PDFToolBox\View\AppView;
	use setasign\Fpdi\PdfReader\PageBoundaries;

	class AppController extends BaseController {
		public const DEFAULT_BOX = PageBoundaries::TRIM_BOX;
		public const CUSTOM_BOX = 'Custom';

		public const BOXES = [
			//self::CUSTOM_BOX => self::CUSTOM_BOX,
			PageBoundaries::CROP_BOX => PageBoundaries::CROP_BOX,
			PageBoundaries::MEDIA_BOX => PageBoundaries::MEDIA_BOX,
			PageBoundaries::BLEED_BOX => PageBoundaries::BLEED_BOX,
			PageBoundaries::TRIM_BOX => PageBoundaries::TRIM_BOX,
			PageBoundaries::ART_BOX => PageBoundaries::ART_BOX,
		];

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
				$size = null;
				$box = self::BOXES[$this->request->getData('box', self::DEFAULT_BOX)] ?? self::DEFAULT_BOX;
				$custom = ($box === self::CUSTOM_BOX);

				$file = $this->request->getUploadedFile('pdf');
				$media_type = $file->getClientMediaType();

				if (!in_array($media_type, ['application/pdf'])) {
					return;
				}

				$path = $file->getStream()->getMetadata('uri');

				$pdf = new FawnoFPDF();

				if ($custom) {
					$box = PageBoundaries::CROP_BOX;
				}

				$pages = $pdf->setSourceFile($path);
				for ($page = 1; $page <= $pages; $page++) {
					$page_id = $pdf->importPage($page, $box);
					$size = $size ?? $pdf->getImportedPageSize($page_id);
					$pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
					$pdf->useTemplate($page_id);
				}

				$filename = pathinfo($file->getClientFilename(), PATHINFO_FILENAME) . '-cropped.pdf';

				$response = $this->response;
				$response = $response->withDisabledCache();
				$response = $response->withStringBody($pdf->Output('S'));
				//$response = $response->withType($media_type);
				$response = $response->withType('mime/pdf');
				$response = $response->withDownload($filename);
				return $response;

				$this->set(compact('file'));
			}
		}
	}
