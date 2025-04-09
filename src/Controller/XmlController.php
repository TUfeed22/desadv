<?php

namespace App\Controller;

use App\Service\DesadvManager;
use App\Service\XmlParserService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class XmlController extends AbstractController
{
    #[Route('/parsing/', name: 'parsing', methods: ['POST'])]
    public function parsing(XmlParserService $xmlParser, DesadvManager $desadvManager, Request $request): JsonResponse
    {
        try {
            $file = $request->files->get('file');

            if (empty($file)) {
                return $this->json([
                    'status' => Response::HTTP_BAD_REQUEST,
                    'message' => 'Ошибка: Файл не загружен.',
                    'id' => null
                ], Response::HTTP_BAD_REQUEST);
            }

            $dto = $xmlParser->parseXml($file);
            $desadv = $desadvManager->create($dto);
            $id = $desadvManager->save($desadv);

            return $this->json([
                'status' => Response::HTTP_OK,
                'message' => 'Данные успешно сохранены',
                'id' => $id,
            ], Response::HTTP_OK);

        } catch (Exception $e) {
            return $this->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Ошибка: ' . $e->getMessage(),
                'id' => null
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}