(function($){

    String.prototype.reverse = function()
    {
        return this.split('').reverse().join('');
    };

    $(document).ready(function()
    {
        const SEGMENT = 100 / 5;

        var meter = $('#form-password-meter');

        var offset = parseInt(meter.css('margin-top'));

        var calculatePasswordScore = function(password)
        {
            var lengthMultiplier = 4;
            var numberMultiplier = 4;
            var symbolMultiplier = 6;
            var middleCharacterMultipler = 2;
            var upperCaseAlphaMultipler = 2;
            var lowerCaseAlphaMultipler = 2;
            var consecutiveNumberMultipler = 2;
            var sequentialAlplaMultipler = 3;
            var sequentialNumberMultipler = 3;
            var sequentialSymbolMultipler = 3;

            var upperCaseAlpha = '';
            var lowerCaseAlpha = '';
            var number = '';
            var symbol = '';
            var repeatCharacterCountIncreasement = 0;

            var repeatChatacterExists = false;
            var upperCaseAlphaCount = 0;
            var lowerCaseAlphaCount = 0;
            var middleCharacterCount = 0;
            var numberCount = 0;
            var symbolCount = 0;
            var repeatCharacterCount = 0;
            var uniqueCharacterCount = 0;

            var consecutiveUpperCaseAlphaCount = 0;
            var consecutiveLowerCaseAlphaCount = 0;
            var consecutiveNumberCount = 0;
            var consecutiveSymbolCount = 0;

            var sequentialAlplaCount = 0;
            var sequentialNumberCount = 0;
            var sequentialSymbolCount = 0;
            var sequentialCharacterCount = 0;

            var length = password.length;
            var score = parseInt(length * lengthMultiplier);
            var array = password.replace(/\s+/g, '').split(/\s*/);

            for ( var index = 0; index < array.length ; ++index )
            {
                if ( array[index].match(/[A-Z]/g) )
                {
                    if ( upperCaseAlpha !== '' )
                    {
                        if ( (upperCaseAlpha + 1) == index ) consecutiveUpperCaseAlphaCount++;
                    }
                    upperCaseAlpha = index;
                    upperCaseAlphaCount++;
                }
                else if ( array[index].match(/[a-z]/g) )
                { 
                    if ( lowerCaseAlpha !== '')
                    {
                        if ( (lowerCaseAlpha + 1) == index ) consecutiveLowerCaseAlphaCount++;
                    }
                    lowerCaseAlpha = index;
                    lowerCaseAlphaCount++;
                }
                else if ( array[index].match(/[0-9]/g) )
                { 
                    if ( index > 0 && index < (array.length - 1) )
                    {
                        middleCharacterCount++;
                    }
                    if ( number !== '' )
                    {
                        if ( (number + 1) == index ) consecutiveNumberCount++;
                    }
                    number = index;
                    numberCount++;
                }
                else if ( array[index].match(/[^a-zA-Z0-9_]/g) )
                { 
                    if ( index > 0 && index < (array.length - 1) )
                    {
                        middleCharacterCount++;
                    }
                    if ( symbol !== '' )
                    {
                        if ( (symbol + 1) == index ) consecutiveSymbolCount++;
                    }
                    symbol = index;
                    symbolCount++;
                }

                for ( var t = 0 ; t < array.length ; ++t )
                {
                    if ( array[index] == array[t] && index != t )
                    {
                        repeatChatacterExists = true;
                        repeatCharacterCountIncreasement += Math.abs(array.length/(t - index));
                    }
                }
                if ( repeatChatacterExists )
                { 
                    repeatCharacterCount++; 
                    uniqueCharacterCount = array.length - repeatCharacterCount;
                    repeatCharacterCountIncreasement = (uniqueCharacterCount) ? Math.ceil(repeatCharacterCountIncreasement / uniqueCharacterCount) : Math.ceil(repeatCharacterCountIncreasement); 
                }
            }

            for ( var t = 0 ; t < 23 ; ++t )
            {
                var forward = 'abcdefghijklmnopqrstuvwxyz'.substring(t, parseInt(t + 3));
                var reverse = forward.reverse();
                if (
                    password.toLowerCase().indexOf(forward) != -1
                 || password.toLowerCase().indexOf(reverse) != -1
                )
                {
                    sequentialAlplaCount++;
                    sequentialCharacterCount++;
                }
            }

            for ( var t = 0 ; t < 8 ; ++t )
            {
                var forward = '01234567890'.substring(t, parseInt(t + 3));
                var reverse = forward.reverse();
                if (
                    password.toLowerCase().indexOf(forward) != -1
                 || password.toLowerCase().indexOf(reverse) != -1
                )
                {
                    sequentialNumberCount++;
                    sequentialCharacterCount++;
                }
            }

            for ( var t = 0 ; t < 8; ++t )
            {
                var forward = ')!@#$%^&*()'.substring(t, parseInt(t + 3));
                var reverse = forward.reverse();
                if (
                    password.toLowerCase().indexOf(forward) != -1
                 || password.toLowerCase().indexOf(reverse) != -1
                )
                {
                    sequentialSymbolCount++;
                    sequentialCharacterCount++;
                }
            }

            if ( upperCaseAlphaCount > 0 && upperCaseAlphaCount < length )
            {
                score += parseInt((length - upperCaseAlphaCount) * 2);
            }
            if ( lowerCaseAlphaCount > 0 && lowerCaseAlphaCount < length )
            {
                score += parseInt((length - lowerCaseAlphaCount) * 2);
            }
            if ( numberCount > 0 && numberCount < length )
            {
                score += parseInt(numberCount * numberMultiplier);
            }
            if ( symbolCount > 0 )
            {
                score += parseInt(symbolCount * symbolMultiplier);
            }
            if ( middleCharacterCount > 0)
            {
                score += parseInt(middleCharacterCount * middleCharacterMultipler);
            }
            if ( (lowerCaseAlphaCount > 0 || upperCaseAlphaCount > 0) && symbolCount === 0 && numberCount === 0 )
            {
                score -= parseInt(length);
            }
            if ( lowerCaseAlphaCount === 0 && upperCaseAlphaCount === 0 && symbolCount === 0 && numberCount > 0 )
            {
                score -= parseInt(length); 
            }
            if ( repeatCharacterCount > 0 )
            {
                score -= parseInt(repeatCharacterCountIncreasement);
            }
            if ( consecutiveUpperCaseAlphaCount > 0 )
            {
                score -= parseInt(consecutiveUpperCaseAlphaCount * upperCaseAlphaMultipler);
            }
            if ( consecutiveLowerCaseAlphaCount > 0 )
            {
                score -= parseInt(consecutiveLowerCaseAlphaCount * lowerCaseAlphaMultipler);
            }
            if ( consecutiveNumberCount > 0 )
            {
                score -= parseInt(consecutiveNumberCount * consecutiveNumberMultipler);
            }
            if ( sequentialAlplaCount > 0 )
            {
                score -= parseInt(sequentialAlplaCount * sequentialAlplaMultipler);
            }
            if ( sequentialNumberCount > 0 )
            {
                score -= parseInt(sequentialNumberCount * sequentialNumberMultipler); 
            }
            if ( sequentialSymbolCount > 0 )
            {
                score -= parseInt(sequentialSymbolCount * sequentialSymbolMultipler);
            }

            if ( length < 8 ) score /= 2;
            if ( score > 100 ) score = 100;
            if ( score < 0 ) score = 0;
            return score;
        };

        var colors = [
            '#FF0000',
            '#F79F1D',
            '#EAF722',
            '#99E653',
            '#3AF463'
        ];

        var checkPasswordStrength = function()
        {
            if ( $(this).val() !== '' )
            {
                var score = calculatePasswordScore($(this).val());
                var level = parseInt(score / SEGMENT) + 1;

                meter.find('td').css({
                    backgroundColor: 'transparent'
                });

                for ( var index = 0 ; index < level ; ++index )
                {
                    meter.find('td').eq(index).css({
                        backgroundColor: colors[level - 1]
                    });
                }
            }
        };

        if ( $('#form-register-password').length )
        {
            checkPasswordStrength.call(
                $('#form-register-password')
                    .keyup(checkPasswordStrength)
                    .keydown(checkPasswordStrength)
            );
        }
    });
})(jQuery);