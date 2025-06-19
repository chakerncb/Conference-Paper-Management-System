<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Paper Decision Notification</title>
    <style>
        /* Inline styles for simplicity, consider using CSS classes for larger templates */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f1f1f1;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 200px;
        }

        .message {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .message p {
            margin-bottom: 10px;
        }

        .paper-title {
            font-weight: bold;
            font-style: italic;
            color: #333;
        }

        .decision {
            margin: 15px 0;
            padding: 10px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .decision-accept {
            background-color: #e6f7e6;
            color: #2e8b57;
            border: 1px solid #2e8b57;
            border-radius: 4px;
        }

        .decision-reject {
            background-color: #ffebeb;
            color: #cc0000;
            border: 1px solid #cc0000;
            border-radius: 4px;
        }

        .decision-revise {
            background-color: #fff9e6;
            color: #b8860b;
            border: 1px solid #b8860b;
            border-radius: 4px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="message">
            <p>Dear {{ $mailData['author_name'] }},</p>
            
            <p>We are writing to inform you about the decision regarding your paper submission:</p>
            
            <p class="paper-title">"{{ $mailData['paper_title'] }}"</p>
            
            <div class="decision 
                @if(strtolower($mailData['decision']) == 'accept' || strtolower($mailData['decision']) == 'accepted')
                    decision-accept
                @elseif(strtolower($mailData['decision']) == 'reject' || strtolower($mailData['decision']) == 'rejected')
                    decision-reject
                @else
                    decision-revise
                @endif
            ">
                Decision: {{ ucfirst($mailData['decision']) }}
            </div>
            
            @if(isset($mailData['comments']))
            <p><strong>Comments from the Program Committee:</strong></p>
            <p>{{ $mailData['comments'] }}</p>
            @endif
            
            @if(strtolower($mailData['decision']) == 'accept' || strtolower($mailData['decision']) == 'accepted')
            <p>Congratulations! Your paper has been accepted for presentation at the conference. Please prepare your camera-ready version according to the guidelines and submit it by the deadline.</p>
            @elseif(strtolower($mailData['decision']) == 'reject' || strtolower($mailData['decision']) == 'rejected')
            <p>We regret to inform you that your paper has not been accepted for presentation at the conference. The review process was highly competitive, and we had to make difficult decisions.</p>
            <p>We encourage you to consider the reviewer feedback for future submissions.</p>
            @else
            <p>Your paper requires revisions before a final decision can be made. Please address the reviewers' comments and resubmit your revised paper by the deadline.</p>
            @endif
            
            <p>Thank you for your contribution to our conference.</p>
            
            <p>Best regards,<br>
            Conference Chair</p>
        </div>
        
        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>

</html>
