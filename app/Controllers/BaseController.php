<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\SiswaModel;
use Config\Services;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    protected $helpers = ['url'];

    protected $namaSiswa = null;
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {

        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        // Jika user login sebagai siswa
        if (session()->get('role') === 'siswa') {
            $siswaModel = new SiswaModel();

            $siswa = $siswaModel
                ->where('user_id', session()->get('user_id'))
                ->first();

            $this->namaSiswa = $siswa['nama'] ?? 'Siswa';

            // Share ke semua view
            Services::renderer()->setVar('namaSiswa', $this->namaSiswa);
        }
    }

    // protected function setNoCache()
    // {
    //     $this->response
    //         ->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
    //         ->setHeader('Cache-Control', 'post-check=0, pre-check=0', false)
    //         ->setHeader('Pragma', 'no-cache')
    //         ->setHeader('Expires', '0');
    // }
}
