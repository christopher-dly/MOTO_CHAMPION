<?php  

namespace App\Twig;

use App\Service\TemporaryMessageService;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class AppExtension extends AbstractExtension implements GlobalsInterface
{
    private $temporaryMessageService;

    public function __construct(TemporaryMessageService $temporaryMessageService)
    {
        $this->temporaryMessageService = $temporaryMessageService;
    }

    public function getGlobals(): array
    {
        return [
            'temporary_message' => $this->temporaryMessageService->getMessage(),
        ];
    }
}
