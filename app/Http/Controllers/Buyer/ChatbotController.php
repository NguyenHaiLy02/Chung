<?php
namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function handleChat(Request $request)
    {
        // Nhận thông điệp từ client
        $clientMessage = $request->input('message');
        
        if (!$clientMessage) {
            return response()->json(['message' => 'Vui lòng nhập câu hỏi!'], 400);
        }

        // Lấy API key từ .env
        $apiKey = env('OPENAI_API_KEY');
        
        if (!$apiKey) {
            return response()->json(['message' => 'API key không được cấu hình.'], 500);
        }

        try {
            // Tạo request tới OpenAI API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type'  => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'Bạn là trợ lý dinh dưỡng thân thiện.'],
                    ['role' => 'user', 'content' => $clientMessage],
                ],
                'max_tokens' => 100,
                'temperature' => 0.7,
            ]);

            // Giải mã phản hồi
            $result = $response->json();

            // Kiểm tra phản hồi từ OpenAI API
            if (isset($result['choices'][0]['message']['content'])) {
                $chatResponse = $result['choices'][0]['message']['content'];
            } else {
                $chatResponse = 'Xin lỗi, tôi không thể trả lời câu hỏi này.';
            }

            // Trả kết quả về cho client
            return response()->json([
                'message' => $chatResponse,
            ]);

        } catch (\Exception $e) {
            // Ghi log lỗi nếu có
            Log::error('Error during OpenAI API request: ' . $e->getMessage());

            // Trả lỗi về client
            return response()->json(['message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau.'], 500);
        }
    }
}
