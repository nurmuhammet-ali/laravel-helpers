<?php

namespace Nurmuhammet\Helpers\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Settings extends Model
{
    use HasFactory;
    
    public const MR = 'mr';
    public const AG = 'ag';
    public const AH = 'ah';
    public const LB = 'lb';
    public const BN = 'bn';
    public const DZ = 'dz';

    public static function regions(): array
    {
        return [
            self::AG => 'Aşgabat',
            self::MR => 'Mary',
            self::AH => 'Ahal',
            self::LB => 'Lebap',
            self::BN => 'Balkan',
            self::DZ => 'Daşoguz',
        ];
    }

    public const I_AS = 'I-AS';
    public const I_MR = 'I-MR';
    public const II_MR = 'II-MR';
    public const I_AH = 'I-AH';
    public const II_AH = 'II-AH';
    public const I_LB = 'I-LB';
    public const II_LB = 'II-LB';
    public const I_BN = 'I-BN';
    public const II_BN = 'II-BN';
    public const I_DZ = 'I-DZ';
    public const II_DZ = 'II-DZ';

    public static function passport_series(): array 
    {
        return [
            self::I_AS => self::I_AS,
            self::I_MR => self::I_MR,
            self::II_MR => self::II_MR,
            self::I_AH => self::I_AH,
            self::II_AH => self::II_AH,
            self::I_LB => self::I_LB,
            self::II_LB => self::II_LB,
            self::I_BN => self::I_BN,
            self::II_BN => self::II_BN,
            self::I_DZ => self::I_DZ,
            self::II_DZ => self::II_DZ,
        ];
    }

    public const PENDING = 'pending';
    public const REGISTER = 'register';
    public const IN_PROGRESS = 'in_progress';
    public const PAID = 'paid';
    public const COMPLETED = 'completed';
    public const FAILED = 'failed';
    public const CANCELLED = 'cancelled';

    public static function orderStatusesValues(): array
    {
        return [
            self::PENDING,
            self::REGISTER,
            self::IN_PROGRESS,
            self::PAID,
            self::COMPLETED,
            self::FAILED,
            self::CANCELLED,
        ];
    }

    public static function orderStatuses(): array
    {
        return [
            self::PENDING => __('Pending'),
            self::REGISTER => __('Registered'),
            self::IN_PROGRESS => __('In progress'),
            self::PAID => __('Paid'),
            self::COMPLETED => __('Completed'),
            self::FAILED => __('Failed'),
            self::CANCELLED => __('Cancelled'),
        ];
    }

    public static function orderStatusClasses(): array
    {
        return [
            self::PENDING => 'warning',
            self::REGISTER => 'info',
            self::IN_PROGRESS => 'info',
            self::PAID => 'primary',
            self::COMPLETED => 'success',
            self::FAILED => 'danger',
            self::CANCELLED => 'danger',
        ];
    }

    public static function countries(): array
    {
        return [
            'Afghan' => 'Owgan',
            'Albanian' => 'Albanian',
            'Algerian' => 'Algerian',
            'American' => 'Amerikan',
            'Andorran' => 'Andorran',
            'Angolan' => 'Angolan',
            'Antiguans' => 'Antiguans',
            'Argentinean' => 'Argentinean',
            'Armenian' => 'Ermeni',
            'Australian' => 'Australian',
            'Austrian' => 'Austrian',
            'Azerbaijani' => 'Azerbeýjan',
            'Bahamian' => 'Bahamian',
            'Bahraini' => 'Bahraini',
            'Bangladeshi' => 'Bangladeshi',
            'Barbadian' => 'Barbadian',
            'Barbudans' => 'Barbudans',
            'Batswana' => 'Batswana',
            'Belarusian' => 'Belarusian',
            'Belgian' => 'Belgian',
            'Belizean' => 'Belizean',
            'Beninese' => 'Beninese',
            'Bhutanese' => 'Bhutanese',
            'Bolivian' => 'Bolivian',
            'Bosnian' => 'Bosnian',
            'Brazilian' => 'Brazilian',
            'British' => 'British',
            'Bruneian' => 'Bruneian',
            'Bulgarian' => 'Bulgarian',
            'Burkinabe' => 'Burkinabe',
            'Burmese' => 'Burmese',
            'Burundian' => 'Burundian',
            'Cambodian' => 'Cambodian',
            'Cameroonian' => 'Cameroonian',
            'Canadian' => 'Canadian',
            'Cape Verdean' => 'Cape Verdean',
            'Central African' => 'Central African',
            'Chadian' => 'Chadian',
            'Chilean' => 'Chilean',
            'Chinese' => 'Chinese',
            'Colombian' => 'Colombian',
            'Comoran' => 'Comoran',
            'Congolese' => 'Congolese',
            'Costa Rican' => 'Costa Rican',
            'Croatian' => 'Croatian',
            'Cuban' => 'Cuban',
            'Cypriot' => 'Cypriot',
            'Czech' => 'Czech',
            'Danish' => 'Danish',
            'Djibouti' => 'Djibouti',
            'Dominican' => 'Dominican',
            'Dutch' => 'Dutch',
            'East Timorese' => 'East Timorese',
            'Ecuadorean' => 'Ecuadorean',
            'Egyptian' => 'Egyptian',
            'Emirian' => 'Emirian',
            'Equatorial Guinean' => 'Equatorial Guinean',
            'Eritrean' => 'Eritrean',
            'Estonian' => 'Estonian',
            'Ethiopian' => 'Ethiopian',
            'Fijian' => 'Fijian',
            'Filipino' => 'Filipino',
            'Finnish' => 'Finnish',
            'French' => 'French',
            'Gabonese' => 'Gabonese',
            'Gambian' => 'Gambian',
            'Georgian' => 'Georgian',
            'German' => 'German',
            'Ghanaian' => 'Ghanaian',
            'Greek' => 'Greek',
            'Grenadian' => 'Grenadian',
            'Guatemalan' => 'Guatemalan',
            'Guinea-Bissauan' => 'Guinea-Bissauan',
            'Guinean' => 'Guinean',
            'Guyanese' => 'Guyanese',
            'Haitian' => 'Haitian',
            'Herzegovinian' => 'Herzegovinian',
            'Honduran' => 'Honduran',
            'Hungarian' => 'Hungarian',
            'I-Kiribati' => 'I-Kiribati',
            'Icelander' => 'Icelander',
            'Indian' => 'Indian',
            'Indonesian' => 'Indonesian',
            'Iranian' => 'Iranian',
            'Iraqi' => 'Iraqi',
            'Irish' => 'Irish',
            'Israeli' => 'Israeli',
            'Italian' => 'Italian',
            'Ivorian' => 'Ivorian',
            'Jamaican' => 'Jamaican',
            'Japanese' => 'Japanese',
            'Jordanian' => 'Jordanian',
            'Kazakhstani' => 'Kazakhstani',
            'Kenyan' => 'Kenyan',
            'Kittian and Nevisian' => 'Kittian and Nevisian',
            'Kuwaiti' => 'Kuwaiti',
            'Kyrgyz' => 'Kyrgyz',
            'Laotian' => 'Laotian',
            'Latvian' => 'Latvian',
            'Lebanese' => 'Lebanese',
            'Liberian' => 'Liberian',
            'Libyan' => 'Libyan',
            'Liechtensteiner' => 'Liechtensteiner',
            'Lithuanian' => 'Lithuanian',
            'Luxembourger' => 'Luxembourger',
            'Macedonian' => 'Macedonian',
            'Malagasy' => 'Malagasy',
            'Malawian' => 'Malawian',
            'Malaysian' => 'Malaysian',
            'Maldivian' => 'Maldivian',
            'Malian' => 'Malian',
            'Maltese' => 'Maltese',
            'Marshallese' => 'Marshallese',
            'Mauritanian' => 'Mauritanian',
            'Mauritian' => 'Mauritian',
            'Mexican' => 'Mexican',
            'Micronesian' => 'Micronesian',
            'Moldovan' => 'Moldovan',
            'Monacan' => 'Monacan',
            'Mongolian' => 'Mongolian',
            'Moroccan' => 'Moroccan',
            'Mosotho' => 'Mosotho',
            'Motswana' => 'Motswana',
            'Mozambican' => 'Mozambican',
            'Namibian' => 'Namibian',
            'Nauruan' => 'Nauruan',
            'Nepalese' => 'Nepalese',
            'New Zealander' => 'New Zealander',
            'Ni-Vanuatu' => 'Ni-Vanuatu',
            'Nicaraguan' => 'Nicaraguan',
            'Nigerian' => 'Nigerian',
            'Nigerien' => 'Nigerien',
            'North Korean' => 'North Korean',
            'Northern Irish' => 'Northern Irish',
            'Norwegian' => 'Norwegian',
            'Omani' => 'Omani',
            'Pakistani' => 'Pakistani',
            'Palauan' => 'Palauan',
            'Panamanian' => 'Panamanian',
            'Papua New Guinean' => 'Papua New Guinean',
            'Paraguayan' => 'Paraguayan',
            'Peruvian' => 'Peruvian',
            'Polish' => 'Polish',
            'Portuguese' => 'Portuguese',
            'Qatari' => 'Qatari',
            'Romanian' => 'Romanian',
            'Russian' => 'Rus',
            'Rwandan' => 'Rwandan',
            'Saint Lucian' => 'Saint Lucian',
            'Salvadoran' => 'Salvadoran',
            'Samoan' => 'Samoan',
            'San Marinese' => 'San Marinese',
            'Sao Tomean' => 'Sao Tomean',
            'Saudi' => 'Saudi',
            'Scottish' => 'Scottish',
            'Senegalese' => 'Senegalese',
            'Serbian' => 'Serbian',
            'Seychellois' => 'Seychellois',
            'Sierra Leonean' => 'Sierra Leonean',
            'Singaporean' => 'Singaporean',
            'Slovakian' => 'Slovakian',
            'Slovenian' => 'Slovenian',
            'Solomon Islander' => 'Solomon Islander',
            'Somali' => 'Somali',
            'South African' => 'South African',
            'South Korean' => 'South Korean',
            'Spanish' => 'Spanish',
            'Sri Lankan' => 'Sri Lankan',
            'Sudanese' => 'Sudanese',
            'Surinamer' => 'Surinamer',
            'Swazi' => 'Swazi',
            'Swedish' => 'Swedish',
            'Swiss' => 'Swiss',
            'Syrian' => 'Syrian',
            'Taiwanese' => 'Taiwanese',
            'Tajik' => 'Tajik',
            'Tanzanian' => 'Tanzanian',
            'Thai' => 'Thai',
            'Togolese' => 'Togolese',
            'Tongan' => 'Tongan',
            'Trinidadian or Tobagonian' => 'Trinidadian or Tobagonian',
            'Tunisian' => 'Tunisian',
            'Turkish' => 'Türk',
            'Turkmen' => 'Türkmen',
            'Tuvaluan' => 'Tuvaluan',
            'Ugandan' => 'Ugandan',
            'Ukrainian' => 'Ukrainian',
            'Uruguayan' => 'Uruguayan',
            'Uzbekistani' => 'Özbek',
            'Venezuelan' => 'Venezuelan',
            'Vietnamese' => 'Vietnamese',
            'Welsh' => 'Welsh',
            'Yemenite' => 'Yemenite',
            'Zambian' => 'Zambian',
            'Zimbabwean' => 'Zimbabwean'
        ];
    }
}
