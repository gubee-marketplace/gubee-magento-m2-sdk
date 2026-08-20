<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Invoice;

use Gubee\SDK\Enum\Catalog\Product\OriginEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class InvoiceItem extends AbstractModel
{
    protected ?string $code = null;

    protected ?string $skuId = null;

    protected ?string $description = null;

    protected ?string $ncm = null;

    protected ?int $cst = null;

    protected ?string $cfop = null;

    protected ?string $unit = null;

    protected ?float $quantity = null;

    protected ?float $icmsSubstituteBaseCalculation = null;

    protected ?float $icmsSubstituteValue = null;

    protected ?float $fcpSubstituteValue = null;

    protected ?float $unitPrice = null;

    protected ?float $totalPrice = null;

    protected ?float $icmsBaseCalculation = null;

    protected ?float $icmsValue = null;

    protected ?float $ipiValue = null;

    protected ?float $icmsPercentage = null;

    protected ?float $ipiPercentage = null;

    protected ?OriginEnum $origin = null;

    protected ?int $icmsModalityBaseCalc = null;

    protected ?int $icmsModalityBaseCalcST = null;

    protected ?int $pisCst = null;

    protected ?int $cofinsCst = null;

    protected ?float $fcpBaseCalculation = null;

    protected ?float $fcpPercentage = null;

    protected ?float $fcpValue = null;

    protected ?float $icmsBaseCalculationDestinationState = null;

    protected ?float $icmsInternalRateDestinationState = null;

    protected ?float $icmsInterstateRate = null;

    protected ?float $icmsSharingPercentage = null;

    protected ?float $icmsValueDestinationState = null;

    protected ?float $icmsValueSenderState = null;

    protected ?float $fcpBaseCalculationDestinationState = null;

    protected ?float $fcpPercentageDestinationState = null;

    protected ?float $fcpValueDestinationState = null;

    protected ?float $icmsReductionBC = null;

    protected ?float $icmsSubstituteRate = null;

    protected ?float $icmsSubstituteReductionBC = null;

    protected ?float $icmsAddedValueMarginSt = null;

    protected ?float $icmsSimpleCreditRate = null;

    protected ?float $icmsSimpleCreditValue = null;

    protected ?float $icmsOperationValue = null;

    protected ?float $icmsDeferredPercentage = null;

    protected ?float $icmsDeferredValue = null;

    protected ?float $icmsStWithheldBC = null;

    protected ?float $icmsStWithheldAmount = null;

    protected ?float $icmsFinalRate = null;

    protected ?float $icmsExemptValue = null;

    protected ?int $icmsExemptReason = null;

    protected ?int $icmsBaseCalculationMono = null;

    protected ?float $icmsValueMono = null;

    protected ?int $icmsWithholdingBaseCalculationMono = null;

    protected ?float $icmsWithholdingRate = null;

    protected ?float $icmsWithholdingValueMono = null;

    protected ?float $icmsPercentualReduction = null;

    protected ?int $icmsReductionReason = null;

    protected ?float $icmsOperationValueMono = null;

    protected ?float $icmsDeferredValueMono = null;

    protected ?int $icmsWithheldBaseCalculation = null;

    protected ?float $icmsWithheldRate = null;

    protected ?float $icmsWithheldValueMono = null;

    protected ?float $pisBaseCalc = null;

    protected ?float $pisRate = null;

    protected ?float $pisQuantity = null;

    protected ?float $pisRateValue = null;

    protected ?float $pisValue = null;

    protected ?float $cofinsBaseCalc = null;

    protected ?float $cofinsRate = null;

    protected ?float $cofinsQuantity = null;

    protected ?float $cofinsRateValue = null;

    protected ?float $cofinsValue = null;

    protected ?int $ipiCst = null;

    protected ?float $ipiBaseCalc = null;

    protected ?float $ipiQuantity = null;

    protected ?float $ipiValuePerTaxableUnit = null;

    protected ?string $ipiProducerCnpj = null;

    protected ?string $ipiControlSealCode = null;

    protected ?int $ipiControlSealQuantity = null;

    protected ?int $ipiClassificationClass = null;

    protected ?string $cest = null;

    protected ?float $discount = null;

    protected ?float $freight = null;

    protected ?string $isTaxSituation = null;

    protected ?string $isClassificationClass = null;

    protected ?float $isBaseCalc = null;

    protected ?float $isRate = null;

    protected ?float $isSpecificRate = null;

    protected ?string $isTaxableUnit = null;

    protected ?float $isTaxableQuantity = null;

    protected ?float $isValue = null;

    protected ?string $ibsCbsTaxSituationCode = null;

    protected ?string $ibsCbsTaxClassificationCode = null;

    protected ?float $ibsCbsTaxBaseValue = null;

    protected ?float $ibsUfRate = null;

    protected ?float $ibsUfDeferralPercentage = null;

    protected ?float $ibsUfDeferredValue = null;

    protected ?float $ibsUfReturnedTaxValue = null;

    protected ?float $ibsUfRateReductionPercentage = null;

    protected ?float $ibsUfEffectiveRate = null;

    protected ?float $ibsUfTaxValue = null;

    protected ?float $ibsMunicipalityRate = null;

    protected ?float $ibsMunicipalityDeferralPercentage = null;

    protected ?float $ibsMunicipalityDeferredValue = null;

    protected ?float $ibsMunicipalityReturnedTaxValue = null;

    protected ?float $ibsMunicipalityRateReductionPercentage = null;

    protected ?float $ibsMunicipalityEffectiveRate = null;

    protected ?float $ibsMunicipalityTaxValue = null;

    protected ?float $ibsTotalValue = null;

    protected ?float $cbsRate = null;

    protected ?float $cbsDeferralPercentage = null;

    protected ?float $cbsDeferredValue = null;

    protected ?float $cbsReturnedTaxValue = null;

    protected ?float $cbsRateReductionPercentage = null;

    protected ?float $cbsEffectiveRate = null;

    protected ?float $cbsValue = null;

    protected ?string $ibsCbsRegularTaxSituationCode = null;

    protected ?string $ibsCbsRegularTaxClassificationCode = null;

    protected ?float $ibsUfRegularEffectiveRate = null;

    protected ?float $ibsUfRegularTaxValue = null;

    protected ?float $ibsMunicipalityRegularEffectiveRate = null;

    protected ?float $ibsMunicipalityRegularTaxValue = null;

    protected ?float $cbsRegularEffectiveRate = null;

    protected ?float $cbsRegularTaxValue = null;

    protected ?int $presumedCreditClassificationCode = null;

    protected ?float $ibsPresumedCreditPercentage = null;

    protected ?float $ibsPresumedCreditValue = null;

    protected ?float $ibsPresumedCreditSuspensiveConditionValue = null;

    protected ?float $cbsPresumedCreditPercentage = null;

    protected ?float $cbsPresumedCreditValue = null;

    protected ?float $cbsPresumedCreditSuspensiveConditionValue = null;

    protected ?string $presumedCreditZfmCompetence = null;

    protected ?string $presumedCreditZfmClassification = null;

    protected ?float $presumedCreditZfmValue = null;

    protected ?float $monoTaxedQuantityBase = null;

    protected ?float $monoIbsAdRemRate = null;

    protected ?float $monoCbsAdRemRate = null;

    protected ?float $monoIbsValue = null;

    protected ?float $monoCbsValue = null;

    protected ?float $monoRetainedTaxedQuantityBase = null;

    protected ?float $monoIbsRetentionRate = null;

    protected ?float $monoIbsRetentionValue = null;

    protected ?float $monoCbsRetentionRate = null;

    protected ?float $monoCbsRetentionValue = null;

    protected ?float $monoPreviouslyRetainedQuantityBase = null;

    protected ?float $monoIbsPreviouslyRetainedRate = null;

    protected ?float $monoIbsPreviouslyRetainedValue = null;

    protected ?float $monoCbsPreviouslyRetainedRate = null;

    protected ?float $monoCbsPreviouslyRetainedValue = null;

    protected ?float $monoIbsDeferredPercentage = null;

    protected ?float $monoIbsDeferredValue = null;

    protected ?float $monoCbsDeferredPercentage = null;

    protected ?float $monoCbsDeferredValue = null;

    protected ?float $monoIbsTotalItem = null;

    protected ?float $monoCbsTotalItem = null;

    protected ?float $ibsTransferredValue = null;

    protected ?float $cbsTransferredValue = null;

    protected ?string $assessmentCompetenceDate = null;

    protected ?float $ibsCompetenceAdjustmentAmount = null;

    protected ?float $cbsCompetenceAdjustmentAmount = null;

    protected ?string $fuelAnpCode = null;

    protected ?string $fuelAnpDescription = null;

    protected ?string $fuelUf = null;

    protected ?string $taxBenefitCode = null;

    public function __construct(
        ?string $code = null,
        ?string $skuId = null,
        ?string $description = null,
        ?string $ncm = null,
        ?int $cst = null,
        ?string $cfop = null,
        ?string $unit = null,
        ?float $quantity = null,
        ?float $icmsSubstituteBaseCalculation = null,
        ?float $icmsSubstituteValue = null,
        ?float $fcpSubstituteValue = null,
        ?float $unitPrice = null,
        ?float $totalPrice = null,
        ?float $icmsBaseCalculation = null,
        ?float $icmsValue = null,
        ?float $ipiValue = null,
        ?float $icmsPercentage = null,
        ?float $ipiPercentage = null,
        OriginEnum|string|null $origin = null,
        ?int $icmsModalityBaseCalc = null,
        ?int $icmsModalityBaseCalcST = null,
        ?int $pisCst = null,
        ?int $cofinsCst = null,
        ?float $fcpBaseCalculation = null,
        ?float $fcpPercentage = null,
        ?float $fcpValue = null,
        ?float $icmsBaseCalculationDestinationState = null,
        ?float $icmsInternalRateDestinationState = null,
        ?float $icmsInterstateRate = null,
        ?float $icmsSharingPercentage = null,
        ?float $icmsValueDestinationState = null,
        ?float $icmsValueSenderState = null,
        ?float $fcpBaseCalculationDestinationState = null,
        ?float $fcpPercentageDestinationState = null,
        ?float $fcpValueDestinationState = null,
        ?float $icmsReductionBC = null,
        ?float $icmsSubstituteRate = null,
        ?float $icmsSubstituteReductionBC = null,
        ?float $icmsAddedValueMarginSt = null,
        ?float $icmsSimpleCreditRate = null,
        ?float $icmsSimpleCreditValue = null,
        ?float $icmsOperationValue = null,
        ?float $icmsDeferredPercentage = null,
        ?float $icmsDeferredValue = null,
        ?float $icmsStWithheldBC = null,
        ?float $icmsStWithheldAmount = null,
        ?float $icmsFinalRate = null,
        ?float $icmsExemptValue = null,
        ?int $icmsExemptReason = null,
        ?int $icmsBaseCalculationMono = null,
        ?float $icmsValueMono = null,
        ?int $icmsWithholdingBaseCalculationMono = null,
        ?float $icmsWithholdingRate = null,
        ?float $icmsWithholdingValueMono = null,
        ?float $icmsPercentualReduction = null,
        ?int $icmsReductionReason = null,
        ?float $icmsOperationValueMono = null,
        ?float $icmsDeferredValueMono = null,
        ?int $icmsWithheldBaseCalculation = null,
        ?float $icmsWithheldRate = null,
        ?float $icmsWithheldValueMono = null,
        ?float $pisBaseCalc = null,
        ?float $pisRate = null,
        ?float $pisQuantity = null,
        ?float $pisRateValue = null,
        ?float $pisValue = null,
        ?float $cofinsBaseCalc = null,
        ?float $cofinsRate = null,
        ?float $cofinsQuantity = null,
        ?float $cofinsRateValue = null,
        ?float $cofinsValue = null,
        ?int $ipiCst = null,
        ?float $ipiBaseCalc = null,
        ?float $ipiQuantity = null,
        ?float $ipiValuePerTaxableUnit = null,
        ?string $ipiProducerCnpj = null,
        ?string $ipiControlSealCode = null,
        ?int $ipiControlSealQuantity = null,
        ?int $ipiClassificationClass = null,
        ?string $cest = null,
        ?float $discount = null,
        ?float $freight = null,
        ?string $isTaxSituation = null,
        ?string $isClassificationClass = null,
        ?float $isBaseCalc = null,
        ?float $isRate = null,
        ?float $isSpecificRate = null,
        ?string $isTaxableUnit = null,
        ?float $isTaxableQuantity = null,
        ?float $isValue = null,
        ?string $ibsCbsTaxSituationCode = null,
        ?string $ibsCbsTaxClassificationCode = null,
        ?float $ibsCbsTaxBaseValue = null,
        ?float $ibsUfRate = null,
        ?float $ibsUfDeferralPercentage = null,
        ?float $ibsUfDeferredValue = null,
        ?float $ibsUfReturnedTaxValue = null,
        ?float $ibsUfRateReductionPercentage = null,
        ?float $ibsUfEffectiveRate = null,
        ?float $ibsUfTaxValue = null,
        ?float $ibsMunicipalityRate = null,
        ?float $ibsMunicipalityDeferralPercentage = null,
        ?float $ibsMunicipalityDeferredValue = null,
        ?float $ibsMunicipalityReturnedTaxValue = null,
        ?float $ibsMunicipalityRateReductionPercentage = null,
        ?float $ibsMunicipalityEffectiveRate = null,
        ?float $ibsMunicipalityTaxValue = null,
        ?float $ibsTotalValue = null,
        ?float $cbsRate = null,
        ?float $cbsDeferralPercentage = null,
        ?float $cbsDeferredValue = null,
        ?float $cbsReturnedTaxValue = null,
        ?float $cbsRateReductionPercentage = null,
        ?float $cbsEffectiveRate = null,
        ?float $cbsValue = null,
        ?string $ibsCbsRegularTaxSituationCode = null,
        ?string $ibsCbsRegularTaxClassificationCode = null,
        ?float $ibsUfRegularEffectiveRate = null,
        ?float $ibsUfRegularTaxValue = null,
        ?float $ibsMunicipalityRegularEffectiveRate = null,
        ?float $ibsMunicipalityRegularTaxValue = null,
        ?float $cbsRegularEffectiveRate = null,
        ?float $cbsRegularTaxValue = null,
        ?int $presumedCreditClassificationCode = null,
        ?float $ibsPresumedCreditPercentage = null,
        ?float $ibsPresumedCreditValue = null,
        ?float $ibsPresumedCreditSuspensiveConditionValue = null,
        ?float $cbsPresumedCreditPercentage = null,
        ?float $cbsPresumedCreditValue = null,
        ?float $cbsPresumedCreditSuspensiveConditionValue = null,
        ?string $presumedCreditZfmCompetence = null,
        ?string $presumedCreditZfmClassification = null,
        ?float $presumedCreditZfmValue = null,
        ?float $monoTaxedQuantityBase = null,
        ?float $monoIbsAdRemRate = null,
        ?float $monoCbsAdRemRate = null,
        ?float $monoIbsValue = null,
        ?float $monoCbsValue = null,
        ?float $monoRetainedTaxedQuantityBase = null,
        ?float $monoIbsRetentionRate = null,
        ?float $monoIbsRetentionValue = null,
        ?float $monoCbsRetentionRate = null,
        ?float $monoCbsRetentionValue = null,
        ?float $monoPreviouslyRetainedQuantityBase = null,
        ?float $monoIbsPreviouslyRetainedRate = null,
        ?float $monoIbsPreviouslyRetainedValue = null,
        ?float $monoCbsPreviouslyRetainedRate = null,
        ?float $monoCbsPreviouslyRetainedValue = null,
        ?float $monoIbsDeferredPercentage = null,
        ?float $monoIbsDeferredValue = null,
        ?float $monoCbsDeferredPercentage = null,
        ?float $monoCbsDeferredValue = null,
        ?float $monoIbsTotalItem = null,
        ?float $monoCbsTotalItem = null,
        ?float $ibsTransferredValue = null,
        ?float $cbsTransferredValue = null,
        ?string $assessmentCompetenceDate = null,
        ?float $ibsCompetenceAdjustmentAmount = null,
        ?float $cbsCompetenceAdjustmentAmount = null,
        ?string $fuelAnpCode = null,
        ?string $fuelAnpDescription = null,
        ?string $fuelUf = null,
        ?string $taxBenefitCode = null
    ) {
        if ($code !== null) {
            $this->setCode($code);
        }
        if ($skuId !== null) {
            $this->setSkuId($skuId);
        }
        if ($description !== null) {
            $this->setDescription($description);
        }
        if ($ncm !== null) {
            $this->setNcm($ncm);
        }
        if ($cst !== null) {
            $this->setCst($cst);
        }
        if ($cfop !== null) {
            $this->setCfop($cfop);
        }
        if ($unit !== null) {
            $this->setUnit($unit);
        }
        if ($quantity !== null) {
            $this->setQuantity($quantity);
        }
        if ($icmsSubstituteBaseCalculation !== null) {
            $this->setIcmsSubstituteBaseCalculation($icmsSubstituteBaseCalculation);
        }
        if ($icmsSubstituteValue !== null) {
            $this->setIcmsSubstituteValue($icmsSubstituteValue);
        }
        if ($fcpSubstituteValue !== null) {
            $this->setFcpSubstituteValue($fcpSubstituteValue);
        }
        if ($unitPrice !== null) {
            $this->setUnitPrice($unitPrice);
        }
        if ($totalPrice !== null) {
            $this->setTotalPrice($totalPrice);
        }
        if ($icmsBaseCalculation !== null) {
            $this->setIcmsBaseCalculation($icmsBaseCalculation);
        }
        if ($icmsValue !== null) {
            $this->setIcmsValue($icmsValue);
        }
        if ($ipiValue !== null) {
            $this->setIpiValue($ipiValue);
        }
        if ($icmsPercentage !== null) {
            $this->setIcmsPercentage($icmsPercentage);
        }
        if ($ipiPercentage !== null) {
            $this->setIpiPercentage($ipiPercentage);
        }
        if ($origin !== null) {
            if (is_string($origin)) {
                $origin = OriginEnum::fromValue($origin);
            }
            $this->setOrigin($origin);
        }
        if ($icmsModalityBaseCalc !== null) {
            $this->setIcmsModalityBaseCalc($icmsModalityBaseCalc);
        }
        if ($icmsModalityBaseCalcST !== null) {
            $this->setIcmsModalityBaseCalcST($icmsModalityBaseCalcST);
        }
        if ($pisCst !== null) {
            $this->setPisCst($pisCst);
        }
        if ($cofinsCst !== null) {
            $this->setCofinsCst($cofinsCst);
        }
        if ($fcpBaseCalculation !== null) {
            $this->setFcpBaseCalculation($fcpBaseCalculation);
        }
        if ($fcpPercentage !== null) {
            $this->setFcpPercentage($fcpPercentage);
        }
        if ($fcpValue !== null) {
            $this->setFcpValue($fcpValue);
        }
        if ($icmsBaseCalculationDestinationState !== null) {
            $this->setIcmsBaseCalculationDestinationState($icmsBaseCalculationDestinationState);
        }
        if ($icmsInternalRateDestinationState !== null) {
            $this->setIcmsInternalRateDestinationState($icmsInternalRateDestinationState);
        }
        if ($icmsInterstateRate !== null) {
            $this->setIcmsInterstateRate($icmsInterstateRate);
        }
        if ($icmsSharingPercentage !== null) {
            $this->setIcmsSharingPercentage($icmsSharingPercentage);
        }
        if ($icmsValueDestinationState !== null) {
            $this->setIcmsValueDestinationState($icmsValueDestinationState);
        }
        if ($icmsValueSenderState !== null) {
            $this->setIcmsValueSenderState($icmsValueSenderState);
        }
        if ($fcpBaseCalculationDestinationState !== null) {
            $this->setFcpBaseCalculationDestinationState($fcpBaseCalculationDestinationState);
        }
        if ($fcpPercentageDestinationState !== null) {
            $this->setFcpPercentageDestinationState($fcpPercentageDestinationState);
        }
        if ($fcpValueDestinationState !== null) {
            $this->setFcpValueDestinationState($fcpValueDestinationState);
        }
        if ($icmsReductionBC !== null) {
            $this->setIcmsReductionBC($icmsReductionBC);
        }
        if ($icmsSubstituteRate !== null) {
            $this->setIcmsSubstituteRate($icmsSubstituteRate);
        }
        if ($icmsSubstituteReductionBC !== null) {
            $this->setIcmsSubstituteReductionBC($icmsSubstituteReductionBC);
        }
        if ($icmsAddedValueMarginSt !== null) {
            $this->setIcmsAddedValueMarginSt($icmsAddedValueMarginSt);
        }
        if ($icmsSimpleCreditRate !== null) {
            $this->setIcmsSimpleCreditRate($icmsSimpleCreditRate);
        }
        if ($icmsSimpleCreditValue !== null) {
            $this->setIcmsSimpleCreditValue($icmsSimpleCreditValue);
        }
        if ($icmsOperationValue !== null) {
            $this->setIcmsOperationValue($icmsOperationValue);
        }
        if ($icmsDeferredPercentage !== null) {
            $this->setIcmsDeferredPercentage($icmsDeferredPercentage);
        }
        if ($icmsDeferredValue !== null) {
            $this->setIcmsDeferredValue($icmsDeferredValue);
        }
        if ($icmsStWithheldBC !== null) {
            $this->setIcmsStWithheldBC($icmsStWithheldBC);
        }
        if ($icmsStWithheldAmount !== null) {
            $this->setIcmsStWithheldAmount($icmsStWithheldAmount);
        }
        if ($icmsFinalRate !== null) {
            $this->setIcmsFinalRate($icmsFinalRate);
        }
        if ($icmsExemptValue !== null) {
            $this->setIcmsExemptValue($icmsExemptValue);
        }
        if ($icmsExemptReason !== null) {
            $this->setIcmsExemptReason($icmsExemptReason);
        }
        if ($icmsBaseCalculationMono !== null) {
            $this->setIcmsBaseCalculationMono($icmsBaseCalculationMono);
        }
        if ($icmsValueMono !== null) {
            $this->setIcmsValueMono($icmsValueMono);
        }
        if ($icmsWithholdingBaseCalculationMono !== null) {
            $this->setIcmsWithholdingBaseCalculationMono($icmsWithholdingBaseCalculationMono);
        }
        if ($icmsWithholdingRate !== null) {
            $this->setIcmsWithholdingRate($icmsWithholdingRate);
        }
        if ($icmsWithholdingValueMono !== null) {
            $this->setIcmsWithholdingValueMono($icmsWithholdingValueMono);
        }
        if ($icmsPercentualReduction !== null) {
            $this->setIcmsPercentualReduction($icmsPercentualReduction);
        }
        if ($icmsReductionReason !== null) {
            $this->setIcmsReductionReason($icmsReductionReason);
        }
        if ($icmsOperationValueMono !== null) {
            $this->setIcmsOperationValueMono($icmsOperationValueMono);
        }
        if ($icmsDeferredValueMono !== null) {
            $this->setIcmsDeferredValueMono($icmsDeferredValueMono);
        }
        if ($icmsWithheldBaseCalculation !== null) {
            $this->setIcmsWithheldBaseCalculation($icmsWithheldBaseCalculation);
        }
        if ($icmsWithheldRate !== null) {
            $this->setIcmsWithheldRate($icmsWithheldRate);
        }
        if ($icmsWithheldValueMono !== null) {
            $this->setIcmsWithheldValueMono($icmsWithheldValueMono);
        }
        if ($pisBaseCalc !== null) {
            $this->setPisBaseCalc($pisBaseCalc);
        }
        if ($pisRate !== null) {
            $this->setPisRate($pisRate);
        }
        if ($pisQuantity !== null) {
            $this->setPisQuantity($pisQuantity);
        }
        if ($pisRateValue !== null) {
            $this->setPisRateValue($pisRateValue);
        }
        if ($pisValue !== null) {
            $this->setPisValue($pisValue);
        }
        if ($cofinsBaseCalc !== null) {
            $this->setCofinsBaseCalc($cofinsBaseCalc);
        }
        if ($cofinsRate !== null) {
            $this->setCofinsRate($cofinsRate);
        }
        if ($cofinsQuantity !== null) {
            $this->setCofinsQuantity($cofinsQuantity);
        }
        if ($cofinsRateValue !== null) {
            $this->setCofinsRateValue($cofinsRateValue);
        }
        if ($cofinsValue !== null) {
            $this->setCofinsValue($cofinsValue);
        }
        if ($ipiCst !== null) {
            $this->setIpiCst($ipiCst);
        }
        if ($ipiBaseCalc !== null) {
            $this->setIpiBaseCalc($ipiBaseCalc);
        }
        if ($ipiQuantity !== null) {
            $this->setIpiQuantity($ipiQuantity);
        }
        if ($ipiValuePerTaxableUnit !== null) {
            $this->setIpiValuePerTaxableUnit($ipiValuePerTaxableUnit);
        }
        if ($ipiProducerCnpj !== null) {
            $this->setIpiProducerCnpj($ipiProducerCnpj);
        }
        if ($ipiControlSealCode !== null) {
            $this->setIpiControlSealCode($ipiControlSealCode);
        }
        if ($ipiControlSealQuantity !== null) {
            $this->setIpiControlSealQuantity($ipiControlSealQuantity);
        }
        if ($ipiClassificationClass !== null) {
            $this->setIpiClassificationClass($ipiClassificationClass);
        }
        if ($cest !== null) {
            $this->setCest($cest);
        }
        if ($discount !== null) {
            $this->setDiscount($discount);
        }
        if ($freight !== null) {
            $this->setFreight($freight);
        }
        if ($isTaxSituation !== null) {
            $this->setIsTaxSituation($isTaxSituation);
        }
        if ($isClassificationClass !== null) {
            $this->setIsClassificationClass($isClassificationClass);
        }
        if ($isBaseCalc !== null) {
            $this->setIsBaseCalc($isBaseCalc);
        }
        if ($isRate !== null) {
            $this->setIsRate($isRate);
        }
        if ($isSpecificRate !== null) {
            $this->setIsSpecificRate($isSpecificRate);
        }
        if ($isTaxableUnit !== null) {
            $this->setIsTaxableUnit($isTaxableUnit);
        }
        if ($isTaxableQuantity !== null) {
            $this->setIsTaxableQuantity($isTaxableQuantity);
        }
        if ($isValue !== null) {
            $this->setIsValue($isValue);
        }
        if ($ibsCbsTaxSituationCode !== null) {
            $this->setIbsCbsTaxSituationCode($ibsCbsTaxSituationCode);
        }
        if ($ibsCbsTaxClassificationCode !== null) {
            $this->setIbsCbsTaxClassificationCode($ibsCbsTaxClassificationCode);
        }
        if ($ibsCbsTaxBaseValue !== null) {
            $this->setIbsCbsTaxBaseValue($ibsCbsTaxBaseValue);
        }
        if ($ibsUfRate !== null) {
            $this->setIbsUfRate($ibsUfRate);
        }
        if ($ibsUfDeferralPercentage !== null) {
            $this->setIbsUfDeferralPercentage($ibsUfDeferralPercentage);
        }
        if ($ibsUfDeferredValue !== null) {
            $this->setIbsUfDeferredValue($ibsUfDeferredValue);
        }
        if ($ibsUfReturnedTaxValue !== null) {
            $this->setIbsUfReturnedTaxValue($ibsUfReturnedTaxValue);
        }
        if ($ibsUfRateReductionPercentage !== null) {
            $this->setIbsUfRateReductionPercentage($ibsUfRateReductionPercentage);
        }
        if ($ibsUfEffectiveRate !== null) {
            $this->setIbsUfEffectiveRate($ibsUfEffectiveRate);
        }
        if ($ibsUfTaxValue !== null) {
            $this->setIbsUfTaxValue($ibsUfTaxValue);
        }
        if ($ibsMunicipalityRate !== null) {
            $this->setIbsMunicipalityRate($ibsMunicipalityRate);
        }
        if ($ibsMunicipalityDeferralPercentage !== null) {
            $this->setIbsMunicipalityDeferralPercentage($ibsMunicipalityDeferralPercentage);
        }
        if ($ibsMunicipalityDeferredValue !== null) {
            $this->setIbsMunicipalityDeferredValue($ibsMunicipalityDeferredValue);
        }
        if ($ibsMunicipalityReturnedTaxValue !== null) {
            $this->setIbsMunicipalityReturnedTaxValue($ibsMunicipalityReturnedTaxValue);
        }
        if ($ibsMunicipalityRateReductionPercentage !== null) {
            $this->setIbsMunicipalityRateReductionPercentage($ibsMunicipalityRateReductionPercentage);
        }
        if ($ibsMunicipalityEffectiveRate !== null) {
            $this->setIbsMunicipalityEffectiveRate($ibsMunicipalityEffectiveRate);
        }
        if ($ibsMunicipalityTaxValue !== null) {
            $this->setIbsMunicipalityTaxValue($ibsMunicipalityTaxValue);
        }
        if ($ibsTotalValue !== null) {
            $this->setIbsTotalValue($ibsTotalValue);
        }
        if ($cbsRate !== null) {
            $this->setCbsRate($cbsRate);
        }
        if ($cbsDeferralPercentage !== null) {
            $this->setCbsDeferralPercentage($cbsDeferralPercentage);
        }
        if ($cbsDeferredValue !== null) {
            $this->setCbsDeferredValue($cbsDeferredValue);
        }
        if ($cbsReturnedTaxValue !== null) {
            $this->setCbsReturnedTaxValue($cbsReturnedTaxValue);
        }
        if ($cbsRateReductionPercentage !== null) {
            $this->setCbsRateReductionPercentage($cbsRateReductionPercentage);
        }
        if ($cbsEffectiveRate !== null) {
            $this->setCbsEffectiveRate($cbsEffectiveRate);
        }
        if ($cbsValue !== null) {
            $this->setCbsValue($cbsValue);
        }
        if ($ibsCbsRegularTaxSituationCode !== null) {
            $this->setIbsCbsRegularTaxSituationCode($ibsCbsRegularTaxSituationCode);
        }
        if ($ibsCbsRegularTaxClassificationCode !== null) {
            $this->setIbsCbsRegularTaxClassificationCode($ibsCbsRegularTaxClassificationCode);
        }
        if ($ibsUfRegularEffectiveRate !== null) {
            $this->setIbsUfRegularEffectiveRate($ibsUfRegularEffectiveRate);
        }
        if ($ibsUfRegularTaxValue !== null) {
            $this->setIbsUfRegularTaxValue($ibsUfRegularTaxValue);
        }
        if ($ibsMunicipalityRegularEffectiveRate !== null) {
            $this->setIbsMunicipalityRegularEffectiveRate($ibsMunicipalityRegularEffectiveRate);
        }
        if ($ibsMunicipalityRegularTaxValue !== null) {
            $this->setIbsMunicipalityRegularTaxValue($ibsMunicipalityRegularTaxValue);
        }
        if ($cbsRegularEffectiveRate !== null) {
            $this->setCbsRegularEffectiveRate($cbsRegularEffectiveRate);
        }
        if ($cbsRegularTaxValue !== null) {
            $this->setCbsRegularTaxValue($cbsRegularTaxValue);
        }
        if ($presumedCreditClassificationCode !== null) {
            $this->setPresumedCreditClassificationCode($presumedCreditClassificationCode);
        }
        if ($ibsPresumedCreditPercentage !== null) {
            $this->setIbsPresumedCreditPercentage($ibsPresumedCreditPercentage);
        }
        if ($ibsPresumedCreditValue !== null) {
            $this->setIbsPresumedCreditValue($ibsPresumedCreditValue);
        }
        if ($ibsPresumedCreditSuspensiveConditionValue !== null) {
            $this->setIbsPresumedCreditSuspensiveConditionValue($ibsPresumedCreditSuspensiveConditionValue);
        }
        if ($cbsPresumedCreditPercentage !== null) {
            $this->setCbsPresumedCreditPercentage($cbsPresumedCreditPercentage);
        }
        if ($cbsPresumedCreditValue !== null) {
            $this->setCbsPresumedCreditValue($cbsPresumedCreditValue);
        }
        if ($cbsPresumedCreditSuspensiveConditionValue !== null) {
            $this->setCbsPresumedCreditSuspensiveConditionValue($cbsPresumedCreditSuspensiveConditionValue);
        }
        if ($presumedCreditZfmCompetence !== null) {
            $this->setPresumedCreditZfmCompetence($presumedCreditZfmCompetence);
        }
        if ($presumedCreditZfmClassification !== null) {
            $this->setPresumedCreditZfmClassification($presumedCreditZfmClassification);
        }
        if ($presumedCreditZfmValue !== null) {
            $this->setPresumedCreditZfmValue($presumedCreditZfmValue);
        }
        if ($monoTaxedQuantityBase !== null) {
            $this->setMonoTaxedQuantityBase($monoTaxedQuantityBase);
        }
        if ($monoIbsAdRemRate !== null) {
            $this->setMonoIbsAdRemRate($monoIbsAdRemRate);
        }
        if ($monoCbsAdRemRate !== null) {
            $this->setMonoCbsAdRemRate($monoCbsAdRemRate);
        }
        if ($monoIbsValue !== null) {
            $this->setMonoIbsValue($monoIbsValue);
        }
        if ($monoCbsValue !== null) {
            $this->setMonoCbsValue($monoCbsValue);
        }
        if ($monoRetainedTaxedQuantityBase !== null) {
            $this->setMonoRetainedTaxedQuantityBase($monoRetainedTaxedQuantityBase);
        }
        if ($monoIbsRetentionRate !== null) {
            $this->setMonoIbsRetentionRate($monoIbsRetentionRate);
        }
        if ($monoIbsRetentionValue !== null) {
            $this->setMonoIbsRetentionValue($monoIbsRetentionValue);
        }
        if ($monoCbsRetentionRate !== null) {
            $this->setMonoCbsRetentionRate($monoCbsRetentionRate);
        }
        if ($monoCbsRetentionValue !== null) {
            $this->setMonoCbsRetentionValue($monoCbsRetentionValue);
        }
        if ($monoPreviouslyRetainedQuantityBase !== null) {
            $this->setMonoPreviouslyRetainedQuantityBase($monoPreviouslyRetainedQuantityBase);
        }
        if ($monoIbsPreviouslyRetainedRate !== null) {
            $this->setMonoIbsPreviouslyRetainedRate($monoIbsPreviouslyRetainedRate);
        }
        if ($monoIbsPreviouslyRetainedValue !== null) {
            $this->setMonoIbsPreviouslyRetainedValue($monoIbsPreviouslyRetainedValue);
        }
        if ($monoCbsPreviouslyRetainedRate !== null) {
            $this->setMonoCbsPreviouslyRetainedRate($monoCbsPreviouslyRetainedRate);
        }
        if ($monoCbsPreviouslyRetainedValue !== null) {
            $this->setMonoCbsPreviouslyRetainedValue($monoCbsPreviouslyRetainedValue);
        }
        if ($monoIbsDeferredPercentage !== null) {
            $this->setMonoIbsDeferredPercentage($monoIbsDeferredPercentage);
        }
        if ($monoIbsDeferredValue !== null) {
            $this->setMonoIbsDeferredValue($monoIbsDeferredValue);
        }
        if ($monoCbsDeferredPercentage !== null) {
            $this->setMonoCbsDeferredPercentage($monoCbsDeferredPercentage);
        }
        if ($monoCbsDeferredValue !== null) {
            $this->setMonoCbsDeferredValue($monoCbsDeferredValue);
        }
        if ($monoIbsTotalItem !== null) {
            $this->setMonoIbsTotalItem($monoIbsTotalItem);
        }
        if ($monoCbsTotalItem !== null) {
            $this->setMonoCbsTotalItem($monoCbsTotalItem);
        }
        if ($ibsTransferredValue !== null) {
            $this->setIbsTransferredValue($ibsTransferredValue);
        }
        if ($cbsTransferredValue !== null) {
            $this->setCbsTransferredValue($cbsTransferredValue);
        }
        if ($assessmentCompetenceDate !== null) {
            $this->setAssessmentCompetenceDate($assessmentCompetenceDate);
        }
        if ($ibsCompetenceAdjustmentAmount !== null) {
            $this->setIbsCompetenceAdjustmentAmount($ibsCompetenceAdjustmentAmount);
        }
        if ($cbsCompetenceAdjustmentAmount !== null) {
            $this->setCbsCompetenceAdjustmentAmount($cbsCompetenceAdjustmentAmount);
        }
        if ($fuelAnpCode !== null) {
            $this->setFuelAnpCode($fuelAnpCode);
        }
        if ($fuelAnpDescription !== null) {
            $this->setFuelAnpDescription($fuelAnpDescription);
        }
        if ($fuelUf !== null) {
            $this->setFuelUf($fuelUf);
        }
        if ($taxBenefitCode !== null) {
            $this->setTaxBenefitCode($taxBenefitCode);
        }
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getSkuId(): ?string
    {
        return $this->skuId;
    }

    public function setSkuId(?string $skuId): self
    {
        $this->skuId = $skuId;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getNcm(): ?string
    {
        return $this->ncm;
    }

    public function setNcm(?string $ncm): self
    {
        $this->ncm = $ncm;
        return $this;
    }

    public function getCst(): ?int
    {
        return $this->cst;
    }

    public function setCst(?int $cst): self
    {
        $this->cst = $cst;
        return $this;
    }

    public function getCfop(): ?string
    {
        return $this->cfop;
    }

    public function setCfop(?string $cfop): self
    {
        $this->cfop = $cfop;
        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(?string $unit): self
    {
        $this->unit = $unit;
        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(?float $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getIcmsSubstituteBaseCalculation(): ?float
    {
        return $this->icmsSubstituteBaseCalculation;
    }

    public function setIcmsSubstituteBaseCalculation(?float $icmsSubstituteBaseCalculation): self
    {
        $this->icmsSubstituteBaseCalculation = $icmsSubstituteBaseCalculation;
        return $this;
    }

    public function getIcmsSubstituteValue(): ?float
    {
        return $this->icmsSubstituteValue;
    }

    public function setIcmsSubstituteValue(?float $icmsSubstituteValue): self
    {
        $this->icmsSubstituteValue = $icmsSubstituteValue;
        return $this;
    }

    public function getFcpSubstituteValue(): ?float
    {
        return $this->fcpSubstituteValue;
    }

    public function setFcpSubstituteValue(?float $fcpSubstituteValue): self
    {
        $this->fcpSubstituteValue = $fcpSubstituteValue;
        return $this;
    }

    public function getUnitPrice(): ?float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(?float $unitPrice): self
    {
        $this->unitPrice = $unitPrice;
        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(?float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    public function getIcmsBaseCalculation(): ?float
    {
        return $this->icmsBaseCalculation;
    }

    public function setIcmsBaseCalculation(?float $icmsBaseCalculation): self
    {
        $this->icmsBaseCalculation = $icmsBaseCalculation;
        return $this;
    }

    public function getIcmsValue(): ?float
    {
        return $this->icmsValue;
    }

    public function setIcmsValue(?float $icmsValue): self
    {
        $this->icmsValue = $icmsValue;
        return $this;
    }

    public function getIpiValue(): ?float
    {
        return $this->ipiValue;
    }

    public function setIpiValue(?float $ipiValue): self
    {
        $this->ipiValue = $ipiValue;
        return $this;
    }

    public function getIcmsPercentage(): ?float
    {
        return $this->icmsPercentage;
    }

    public function setIcmsPercentage(?float $icmsPercentage): self
    {
        $this->icmsPercentage = $icmsPercentage;
        return $this;
    }

    public function getIpiPercentage(): ?float
    {
        return $this->ipiPercentage;
    }

    public function setIpiPercentage(?float $ipiPercentage): self
    {
        $this->ipiPercentage = $ipiPercentage;
        return $this;
    }

    public function getOrigin(): ?OriginEnum
    {
        return $this->origin;
    }

    public function setOrigin(?OriginEnum $origin): self
    {
        $this->origin = $origin;
        return $this;
    }

    public function getIcmsModalityBaseCalc(): ?int
    {
        return $this->icmsModalityBaseCalc;
    }

    public function setIcmsModalityBaseCalc(?int $icmsModalityBaseCalc): self
    {
        $this->icmsModalityBaseCalc = $icmsModalityBaseCalc;
        return $this;
    }

    public function getIcmsModalityBaseCalcST(): ?int
    {
        return $this->icmsModalityBaseCalcST;
    }

    public function setIcmsModalityBaseCalcST(?int $icmsModalityBaseCalcST): self
    {
        $this->icmsModalityBaseCalcST = $icmsModalityBaseCalcST;
        return $this;
    }

    public function getPisCst(): ?int
    {
        return $this->pisCst;
    }

    public function setPisCst(?int $pisCst): self
    {
        $this->pisCst = $pisCst;
        return $this;
    }

    public function getCofinsCst(): ?int
    {
        return $this->cofinsCst;
    }

    public function setCofinsCst(?int $cofinsCst): self
    {
        $this->cofinsCst = $cofinsCst;
        return $this;
    }

    public function getFcpBaseCalculation(): ?float
    {
        return $this->fcpBaseCalculation;
    }

    public function setFcpBaseCalculation(?float $fcpBaseCalculation): self
    {
        $this->fcpBaseCalculation = $fcpBaseCalculation;
        return $this;
    }

    public function getFcpPercentage(): ?float
    {
        return $this->fcpPercentage;
    }

    public function setFcpPercentage(?float $fcpPercentage): self
    {
        $this->fcpPercentage = $fcpPercentage;
        return $this;
    }

    public function getFcpValue(): ?float
    {
        return $this->fcpValue;
    }

    public function setFcpValue(?float $fcpValue): self
    {
        $this->fcpValue = $fcpValue;
        return $this;
    }

    public function getIcmsBaseCalculationDestinationState(): ?float
    {
        return $this->icmsBaseCalculationDestinationState;
    }

    public function setIcmsBaseCalculationDestinationState(?float $icmsBaseCalculationDestinationState): self
    {
        $this->icmsBaseCalculationDestinationState = $icmsBaseCalculationDestinationState;
        return $this;
    }

    public function getIcmsInternalRateDestinationState(): ?float
    {
        return $this->icmsInternalRateDestinationState;
    }

    public function setIcmsInternalRateDestinationState(?float $icmsInternalRateDestinationState): self
    {
        $this->icmsInternalRateDestinationState = $icmsInternalRateDestinationState;
        return $this;
    }

    public function getIcmsInterstateRate(): ?float
    {
        return $this->icmsInterstateRate;
    }

    public function setIcmsInterstateRate(?float $icmsInterstateRate): self
    {
        $this->icmsInterstateRate = $icmsInterstateRate;
        return $this;
    }

    public function getIcmsSharingPercentage(): ?float
    {
        return $this->icmsSharingPercentage;
    }

    public function setIcmsSharingPercentage(?float $icmsSharingPercentage): self
    {
        $this->icmsSharingPercentage = $icmsSharingPercentage;
        return $this;
    }

    public function getIcmsValueDestinationState(): ?float
    {
        return $this->icmsValueDestinationState;
    }

    public function setIcmsValueDestinationState(?float $icmsValueDestinationState): self
    {
        $this->icmsValueDestinationState = $icmsValueDestinationState;
        return $this;
    }

    public function getIcmsValueSenderState(): ?float
    {
        return $this->icmsValueSenderState;
    }

    public function setIcmsValueSenderState(?float $icmsValueSenderState): self
    {
        $this->icmsValueSenderState = $icmsValueSenderState;
        return $this;
    }

    public function getFcpBaseCalculationDestinationState(): ?float
    {
        return $this->fcpBaseCalculationDestinationState;
    }

    public function setFcpBaseCalculationDestinationState(?float $fcpBaseCalculationDestinationState): self
    {
        $this->fcpBaseCalculationDestinationState = $fcpBaseCalculationDestinationState;
        return $this;
    }

    public function getFcpPercentageDestinationState(): ?float
    {
        return $this->fcpPercentageDestinationState;
    }

    public function setFcpPercentageDestinationState(?float $fcpPercentageDestinationState): self
    {
        $this->fcpPercentageDestinationState = $fcpPercentageDestinationState;
        return $this;
    }

    public function getFcpValueDestinationState(): ?float
    {
        return $this->fcpValueDestinationState;
    }

    public function setFcpValueDestinationState(?float $fcpValueDestinationState): self
    {
        $this->fcpValueDestinationState = $fcpValueDestinationState;
        return $this;
    }

    public function getIcmsReductionBC(): ?float
    {
        return $this->icmsReductionBC;
    }

    public function setIcmsReductionBC(?float $icmsReductionBC): self
    {
        $this->icmsReductionBC = $icmsReductionBC;
        return $this;
    }

    public function getIcmsSubstituteRate(): ?float
    {
        return $this->icmsSubstituteRate;
    }

    public function setIcmsSubstituteRate(?float $icmsSubstituteRate): self
    {
        $this->icmsSubstituteRate = $icmsSubstituteRate;
        return $this;
    }

    public function getIcmsSubstituteReductionBC(): ?float
    {
        return $this->icmsSubstituteReductionBC;
    }

    public function setIcmsSubstituteReductionBC(?float $icmsSubstituteReductionBC): self
    {
        $this->icmsSubstituteReductionBC = $icmsSubstituteReductionBC;
        return $this;
    }

    public function getIcmsAddedValueMarginSt(): ?float
    {
        return $this->icmsAddedValueMarginSt;
    }

    public function setIcmsAddedValueMarginSt(?float $icmsAddedValueMarginSt): self
    {
        $this->icmsAddedValueMarginSt = $icmsAddedValueMarginSt;
        return $this;
    }

    public function getIcmsSimpleCreditRate(): ?float
    {
        return $this->icmsSimpleCreditRate;
    }

    public function setIcmsSimpleCreditRate(?float $icmsSimpleCreditRate): self
    {
        $this->icmsSimpleCreditRate = $icmsSimpleCreditRate;
        return $this;
    }

    public function getIcmsSimpleCreditValue(): ?float
    {
        return $this->icmsSimpleCreditValue;
    }

    public function setIcmsSimpleCreditValue(?float $icmsSimpleCreditValue): self
    {
        $this->icmsSimpleCreditValue = $icmsSimpleCreditValue;
        return $this;
    }

    public function getIcmsOperationValue(): ?float
    {
        return $this->icmsOperationValue;
    }

    public function setIcmsOperationValue(?float $icmsOperationValue): self
    {
        $this->icmsOperationValue = $icmsOperationValue;
        return $this;
    }

    public function getIcmsDeferredPercentage(): ?float
    {
        return $this->icmsDeferredPercentage;
    }

    public function setIcmsDeferredPercentage(?float $icmsDeferredPercentage): self
    {
        $this->icmsDeferredPercentage = $icmsDeferredPercentage;
        return $this;
    }

    public function getIcmsDeferredValue(): ?float
    {
        return $this->icmsDeferredValue;
    }

    public function setIcmsDeferredValue(?float $icmsDeferredValue): self
    {
        $this->icmsDeferredValue = $icmsDeferredValue;
        return $this;
    }

    public function getIcmsStWithheldBC(): ?float
    {
        return $this->icmsStWithheldBC;
    }

    public function setIcmsStWithheldBC(?float $icmsStWithheldBC): self
    {
        $this->icmsStWithheldBC = $icmsStWithheldBC;
        return $this;
    }

    public function getIcmsStWithheldAmount(): ?float
    {
        return $this->icmsStWithheldAmount;
    }

    public function setIcmsStWithheldAmount(?float $icmsStWithheldAmount): self
    {
        $this->icmsStWithheldAmount = $icmsStWithheldAmount;
        return $this;
    }

    public function getIcmsFinalRate(): ?float
    {
        return $this->icmsFinalRate;
    }

    public function setIcmsFinalRate(?float $icmsFinalRate): self
    {
        $this->icmsFinalRate = $icmsFinalRate;
        return $this;
    }

    public function getIcmsExemptValue(): ?float
    {
        return $this->icmsExemptValue;
    }

    public function setIcmsExemptValue(?float $icmsExemptValue): self
    {
        $this->icmsExemptValue = $icmsExemptValue;
        return $this;
    }

    public function getIcmsExemptReason(): ?int
    {
        return $this->icmsExemptReason;
    }

    public function setIcmsExemptReason(?int $icmsExemptReason): self
    {
        $this->icmsExemptReason = $icmsExemptReason;
        return $this;
    }

    public function getIcmsBaseCalculationMono(): ?int
    {
        return $this->icmsBaseCalculationMono;
    }

    public function setIcmsBaseCalculationMono(?int $icmsBaseCalculationMono): self
    {
        $this->icmsBaseCalculationMono = $icmsBaseCalculationMono;
        return $this;
    }

    public function getIcmsValueMono(): ?float
    {
        return $this->icmsValueMono;
    }

    public function setIcmsValueMono(?float $icmsValueMono): self
    {
        $this->icmsValueMono = $icmsValueMono;
        return $this;
    }

    public function getIcmsWithholdingBaseCalculationMono(): ?int
    {
        return $this->icmsWithholdingBaseCalculationMono;
    }

    public function setIcmsWithholdingBaseCalculationMono(?int $icmsWithholdingBaseCalculationMono): self
    {
        $this->icmsWithholdingBaseCalculationMono = $icmsWithholdingBaseCalculationMono;
        return $this;
    }

    public function getIcmsWithholdingRate(): ?float
    {
        return $this->icmsWithholdingRate;
    }

    public function setIcmsWithholdingRate(?float $icmsWithholdingRate): self
    {
        $this->icmsWithholdingRate = $icmsWithholdingRate;
        return $this;
    }

    public function getIcmsWithholdingValueMono(): ?float
    {
        return $this->icmsWithholdingValueMono;
    }

    public function setIcmsWithholdingValueMono(?float $icmsWithholdingValueMono): self
    {
        $this->icmsWithholdingValueMono = $icmsWithholdingValueMono;
        return $this;
    }

    public function getIcmsPercentualReduction(): ?float
    {
        return $this->icmsPercentualReduction;
    }

    public function setIcmsPercentualReduction(?float $icmsPercentualReduction): self
    {
        $this->icmsPercentualReduction = $icmsPercentualReduction;
        return $this;
    }

    public function getIcmsReductionReason(): ?int
    {
        return $this->icmsReductionReason;
    }

    public function setIcmsReductionReason(?int $icmsReductionReason): self
    {
        $this->icmsReductionReason = $icmsReductionReason;
        return $this;
    }

    public function getIcmsOperationValueMono(): ?float
    {
        return $this->icmsOperationValueMono;
    }

    public function setIcmsOperationValueMono(?float $icmsOperationValueMono): self
    {
        $this->icmsOperationValueMono = $icmsOperationValueMono;
        return $this;
    }

    public function getIcmsDeferredValueMono(): ?float
    {
        return $this->icmsDeferredValueMono;
    }

    public function setIcmsDeferredValueMono(?float $icmsDeferredValueMono): self
    {
        $this->icmsDeferredValueMono = $icmsDeferredValueMono;
        return $this;
    }

    public function getIcmsWithheldBaseCalculation(): ?int
    {
        return $this->icmsWithheldBaseCalculation;
    }

    public function setIcmsWithheldBaseCalculation(?int $icmsWithheldBaseCalculation): self
    {
        $this->icmsWithheldBaseCalculation = $icmsWithheldBaseCalculation;
        return $this;
    }

    public function getIcmsWithheldRate(): ?float
    {
        return $this->icmsWithheldRate;
    }

    public function setIcmsWithheldRate(?float $icmsWithheldRate): self
    {
        $this->icmsWithheldRate = $icmsWithheldRate;
        return $this;
    }

    public function getIcmsWithheldValueMono(): ?float
    {
        return $this->icmsWithheldValueMono;
    }

    public function setIcmsWithheldValueMono(?float $icmsWithheldValueMono): self
    {
        $this->icmsWithheldValueMono = $icmsWithheldValueMono;
        return $this;
    }

    public function getPisBaseCalc(): ?float
    {
        return $this->pisBaseCalc;
    }

    public function setPisBaseCalc(?float $pisBaseCalc): self
    {
        $this->pisBaseCalc = $pisBaseCalc;
        return $this;
    }

    public function getPisRate(): ?float
    {
        return $this->pisRate;
    }

    public function setPisRate(?float $pisRate): self
    {
        $this->pisRate = $pisRate;
        return $this;
    }

    public function getPisQuantity(): ?float
    {
        return $this->pisQuantity;
    }

    public function setPisQuantity(?float $pisQuantity): self
    {
        $this->pisQuantity = $pisQuantity;
        return $this;
    }

    public function getPisRateValue(): ?float
    {
        return $this->pisRateValue;
    }

    public function setPisRateValue(?float $pisRateValue): self
    {
        $this->pisRateValue = $pisRateValue;
        return $this;
    }

    public function getPisValue(): ?float
    {
        return $this->pisValue;
    }

    public function setPisValue(?float $pisValue): self
    {
        $this->pisValue = $pisValue;
        return $this;
    }

    public function getCofinsBaseCalc(): ?float
    {
        return $this->cofinsBaseCalc;
    }

    public function setCofinsBaseCalc(?float $cofinsBaseCalc): self
    {
        $this->cofinsBaseCalc = $cofinsBaseCalc;
        return $this;
    }

    public function getCofinsRate(): ?float
    {
        return $this->cofinsRate;
    }

    public function setCofinsRate(?float $cofinsRate): self
    {
        $this->cofinsRate = $cofinsRate;
        return $this;
    }

    public function getCofinsQuantity(): ?float
    {
        return $this->cofinsQuantity;
    }

    public function setCofinsQuantity(?float $cofinsQuantity): self
    {
        $this->cofinsQuantity = $cofinsQuantity;
        return $this;
    }

    public function getCofinsRateValue(): ?float
    {
        return $this->cofinsRateValue;
    }

    public function setCofinsRateValue(?float $cofinsRateValue): self
    {
        $this->cofinsRateValue = $cofinsRateValue;
        return $this;
    }

    public function getCofinsValue(): ?float
    {
        return $this->cofinsValue;
    }

    public function setCofinsValue(?float $cofinsValue): self
    {
        $this->cofinsValue = $cofinsValue;
        return $this;
    }

    public function getIpiCst(): ?int
    {
        return $this->ipiCst;
    }

    public function setIpiCst(?int $ipiCst): self
    {
        $this->ipiCst = $ipiCst;
        return $this;
    }

    public function getIpiBaseCalc(): ?float
    {
        return $this->ipiBaseCalc;
    }

    public function setIpiBaseCalc(?float $ipiBaseCalc): self
    {
        $this->ipiBaseCalc = $ipiBaseCalc;
        return $this;
    }

    public function getIpiQuantity(): ?float
    {
        return $this->ipiQuantity;
    }

    public function setIpiQuantity(?float $ipiQuantity): self
    {
        $this->ipiQuantity = $ipiQuantity;
        return $this;
    }

    public function getIpiValuePerTaxableUnit(): ?float
    {
        return $this->ipiValuePerTaxableUnit;
    }

    public function setIpiValuePerTaxableUnit(?float $ipiValuePerTaxableUnit): self
    {
        $this->ipiValuePerTaxableUnit = $ipiValuePerTaxableUnit;
        return $this;
    }

    public function getIpiProducerCnpj(): ?string
    {
        return $this->ipiProducerCnpj;
    }

    public function setIpiProducerCnpj(?string $ipiProducerCnpj): self
    {
        $this->ipiProducerCnpj = $ipiProducerCnpj;
        return $this;
    }

    public function getIpiControlSealCode(): ?string
    {
        return $this->ipiControlSealCode;
    }

    public function setIpiControlSealCode(?string $ipiControlSealCode): self
    {
        $this->ipiControlSealCode = $ipiControlSealCode;
        return $this;
    }

    public function getIpiControlSealQuantity(): ?int
    {
        return $this->ipiControlSealQuantity;
    }

    public function setIpiControlSealQuantity(?int $ipiControlSealQuantity): self
    {
        $this->ipiControlSealQuantity = $ipiControlSealQuantity;
        return $this;
    }

    public function getIpiClassificationClass(): ?int
    {
        return $this->ipiClassificationClass;
    }

    public function setIpiClassificationClass(?int $ipiClassificationClass): self
    {
        $this->ipiClassificationClass = $ipiClassificationClass;
        return $this;
    }

    public function getCest(): ?string
    {
        return $this->cest;
    }

    public function setCest(?string $cest): self
    {
        $this->cest = $cest;
        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): self
    {
        $this->discount = $discount;
        return $this;
    }

    public function getFreight(): ?float
    {
        return $this->freight;
    }

    public function setFreight(?float $freight): self
    {
        $this->freight = $freight;
        return $this;
    }

    public function getIsTaxSituation(): ?string
    {
        return $this->isTaxSituation;
    }

    public function setIsTaxSituation(?string $isTaxSituation): self
    {
        $this->isTaxSituation = $isTaxSituation;
        return $this;
    }

    public function getIsClassificationClass(): ?string
    {
        return $this->isClassificationClass;
    }

    public function setIsClassificationClass(?string $isClassificationClass): self
    {
        $this->isClassificationClass = $isClassificationClass;
        return $this;
    }

    public function getIsBaseCalc(): ?float
    {
        return $this->isBaseCalc;
    }

    public function setIsBaseCalc(?float $isBaseCalc): self
    {
        $this->isBaseCalc = $isBaseCalc;
        return $this;
    }

    public function getIsRate(): ?float
    {
        return $this->isRate;
    }

    public function setIsRate(?float $isRate): self
    {
        $this->isRate = $isRate;
        return $this;
    }

    public function getIsSpecificRate(): ?float
    {
        return $this->isSpecificRate;
    }

    public function setIsSpecificRate(?float $isSpecificRate): self
    {
        $this->isSpecificRate = $isSpecificRate;
        return $this;
    }

    public function getIsTaxableUnit(): ?string
    {
        return $this->isTaxableUnit;
    }

    public function setIsTaxableUnit(?string $isTaxableUnit): self
    {
        $this->isTaxableUnit = $isTaxableUnit;
        return $this;
    }

    public function getIsTaxableQuantity(): ?float
    {
        return $this->isTaxableQuantity;
    }

    public function setIsTaxableQuantity(?float $isTaxableQuantity): self
    {
        $this->isTaxableQuantity = $isTaxableQuantity;
        return $this;
    }

    public function getIsValue(): ?float
    {
        return $this->isValue;
    }

    public function setIsValue(?float $isValue): self
    {
        $this->isValue = $isValue;
        return $this;
    }

    public function getIbsCbsTaxSituationCode(): ?string
    {
        return $this->ibsCbsTaxSituationCode;
    }

    public function setIbsCbsTaxSituationCode(?string $ibsCbsTaxSituationCode): self
    {
        $this->ibsCbsTaxSituationCode = $ibsCbsTaxSituationCode;
        return $this;
    }

    public function getIbsCbsTaxClassificationCode(): ?string
    {
        return $this->ibsCbsTaxClassificationCode;
    }

    public function setIbsCbsTaxClassificationCode(?string $ibsCbsTaxClassificationCode): self
    {
        $this->ibsCbsTaxClassificationCode = $ibsCbsTaxClassificationCode;
        return $this;
    }

    public function getIbsCbsTaxBaseValue(): ?float
    {
        return $this->ibsCbsTaxBaseValue;
    }

    public function setIbsCbsTaxBaseValue(?float $ibsCbsTaxBaseValue): self
    {
        $this->ibsCbsTaxBaseValue = $ibsCbsTaxBaseValue;
        return $this;
    }

    public function getIbsUfRate(): ?float
    {
        return $this->ibsUfRate;
    }

    public function setIbsUfRate(?float $ibsUfRate): self
    {
        $this->ibsUfRate = $ibsUfRate;
        return $this;
    }

    public function getIbsUfDeferralPercentage(): ?float
    {
        return $this->ibsUfDeferralPercentage;
    }

    public function setIbsUfDeferralPercentage(?float $ibsUfDeferralPercentage): self
    {
        $this->ibsUfDeferralPercentage = $ibsUfDeferralPercentage;
        return $this;
    }

    public function getIbsUfDeferredValue(): ?float
    {
        return $this->ibsUfDeferredValue;
    }

    public function setIbsUfDeferredValue(?float $ibsUfDeferredValue): self
    {
        $this->ibsUfDeferredValue = $ibsUfDeferredValue;
        return $this;
    }

    public function getIbsUfReturnedTaxValue(): ?float
    {
        return $this->ibsUfReturnedTaxValue;
    }

    public function setIbsUfReturnedTaxValue(?float $ibsUfReturnedTaxValue): self
    {
        $this->ibsUfReturnedTaxValue = $ibsUfReturnedTaxValue;
        return $this;
    }

    public function getIbsUfRateReductionPercentage(): ?float
    {
        return $this->ibsUfRateReductionPercentage;
    }

    public function setIbsUfRateReductionPercentage(?float $ibsUfRateReductionPercentage): self
    {
        $this->ibsUfRateReductionPercentage = $ibsUfRateReductionPercentage;
        return $this;
    }

    public function getIbsUfEffectiveRate(): ?float
    {
        return $this->ibsUfEffectiveRate;
    }

    public function setIbsUfEffectiveRate(?float $ibsUfEffectiveRate): self
    {
        $this->ibsUfEffectiveRate = $ibsUfEffectiveRate;
        return $this;
    }

    public function getIbsUfTaxValue(): ?float
    {
        return $this->ibsUfTaxValue;
    }

    public function setIbsUfTaxValue(?float $ibsUfTaxValue): self
    {
        $this->ibsUfTaxValue = $ibsUfTaxValue;
        return $this;
    }

    public function getIbsMunicipalityRate(): ?float
    {
        return $this->ibsMunicipalityRate;
    }

    public function setIbsMunicipalityRate(?float $ibsMunicipalityRate): self
    {
        $this->ibsMunicipalityRate = $ibsMunicipalityRate;
        return $this;
    }

    public function getIbsMunicipalityDeferralPercentage(): ?float
    {
        return $this->ibsMunicipalityDeferralPercentage;
    }

    public function setIbsMunicipalityDeferralPercentage(?float $ibsMunicipalityDeferralPercentage): self
    {
        $this->ibsMunicipalityDeferralPercentage = $ibsMunicipalityDeferralPercentage;
        return $this;
    }

    public function getIbsMunicipalityDeferredValue(): ?float
    {
        return $this->ibsMunicipalityDeferredValue;
    }

    public function setIbsMunicipalityDeferredValue(?float $ibsMunicipalityDeferredValue): self
    {
        $this->ibsMunicipalityDeferredValue = $ibsMunicipalityDeferredValue;
        return $this;
    }

    public function getIbsMunicipalityReturnedTaxValue(): ?float
    {
        return $this->ibsMunicipalityReturnedTaxValue;
    }

    public function setIbsMunicipalityReturnedTaxValue(?float $ibsMunicipalityReturnedTaxValue): self
    {
        $this->ibsMunicipalityReturnedTaxValue = $ibsMunicipalityReturnedTaxValue;
        return $this;
    }

    public function getIbsMunicipalityRateReductionPercentage(): ?float
    {
        return $this->ibsMunicipalityRateReductionPercentage;
    }

    public function setIbsMunicipalityRateReductionPercentage(?float $ibsMunicipalityRateReductionPercentage): self
    {
        $this->ibsMunicipalityRateReductionPercentage = $ibsMunicipalityRateReductionPercentage;
        return $this;
    }

    public function getIbsMunicipalityEffectiveRate(): ?float
    {
        return $this->ibsMunicipalityEffectiveRate;
    }

    public function setIbsMunicipalityEffectiveRate(?float $ibsMunicipalityEffectiveRate): self
    {
        $this->ibsMunicipalityEffectiveRate = $ibsMunicipalityEffectiveRate;
        return $this;
    }

    public function getIbsMunicipalityTaxValue(): ?float
    {
        return $this->ibsMunicipalityTaxValue;
    }

    public function setIbsMunicipalityTaxValue(?float $ibsMunicipalityTaxValue): self
    {
        $this->ibsMunicipalityTaxValue = $ibsMunicipalityTaxValue;
        return $this;
    }

    public function getIbsTotalValue(): ?float
    {
        return $this->ibsTotalValue;
    }

    public function setIbsTotalValue(?float $ibsTotalValue): self
    {
        $this->ibsTotalValue = $ibsTotalValue;
        return $this;
    }

    public function getCbsRate(): ?float
    {
        return $this->cbsRate;
    }

    public function setCbsRate(?float $cbsRate): self
    {
        $this->cbsRate = $cbsRate;
        return $this;
    }

    public function getCbsDeferralPercentage(): ?float
    {
        return $this->cbsDeferralPercentage;
    }

    public function setCbsDeferralPercentage(?float $cbsDeferralPercentage): self
    {
        $this->cbsDeferralPercentage = $cbsDeferralPercentage;
        return $this;
    }

    public function getCbsDeferredValue(): ?float
    {
        return $this->cbsDeferredValue;
    }

    public function setCbsDeferredValue(?float $cbsDeferredValue): self
    {
        $this->cbsDeferredValue = $cbsDeferredValue;
        return $this;
    }

    public function getCbsReturnedTaxValue(): ?float
    {
        return $this->cbsReturnedTaxValue;
    }

    public function setCbsReturnedTaxValue(?float $cbsReturnedTaxValue): self
    {
        $this->cbsReturnedTaxValue = $cbsReturnedTaxValue;
        return $this;
    }

    public function getCbsRateReductionPercentage(): ?float
    {
        return $this->cbsRateReductionPercentage;
    }

    public function setCbsRateReductionPercentage(?float $cbsRateReductionPercentage): self
    {
        $this->cbsRateReductionPercentage = $cbsRateReductionPercentage;
        return $this;
    }

    public function getCbsEffectiveRate(): ?float
    {
        return $this->cbsEffectiveRate;
    }

    public function setCbsEffectiveRate(?float $cbsEffectiveRate): self
    {
        $this->cbsEffectiveRate = $cbsEffectiveRate;
        return $this;
    }

    public function getCbsValue(): ?float
    {
        return $this->cbsValue;
    }

    public function setCbsValue(?float $cbsValue): self
    {
        $this->cbsValue = $cbsValue;
        return $this;
    }

    public function getIbsCbsRegularTaxSituationCode(): ?string
    {
        return $this->ibsCbsRegularTaxSituationCode;
    }

    public function setIbsCbsRegularTaxSituationCode(?string $ibsCbsRegularTaxSituationCode): self
    {
        $this->ibsCbsRegularTaxSituationCode = $ibsCbsRegularTaxSituationCode;
        return $this;
    }

    public function getIbsCbsRegularTaxClassificationCode(): ?string
    {
        return $this->ibsCbsRegularTaxClassificationCode;
    }

    public function setIbsCbsRegularTaxClassificationCode(?string $ibsCbsRegularTaxClassificationCode): self
    {
        $this->ibsCbsRegularTaxClassificationCode = $ibsCbsRegularTaxClassificationCode;
        return $this;
    }

    public function getIbsUfRegularEffectiveRate(): ?float
    {
        return $this->ibsUfRegularEffectiveRate;
    }

    public function setIbsUfRegularEffectiveRate(?float $ibsUfRegularEffectiveRate): self
    {
        $this->ibsUfRegularEffectiveRate = $ibsUfRegularEffectiveRate;
        return $this;
    }

    public function getIbsUfRegularTaxValue(): ?float
    {
        return $this->ibsUfRegularTaxValue;
    }

    public function setIbsUfRegularTaxValue(?float $ibsUfRegularTaxValue): self
    {
        $this->ibsUfRegularTaxValue = $ibsUfRegularTaxValue;
        return $this;
    }

    public function getIbsMunicipalityRegularEffectiveRate(): ?float
    {
        return $this->ibsMunicipalityRegularEffectiveRate;
    }

    public function setIbsMunicipalityRegularEffectiveRate(?float $ibsMunicipalityRegularEffectiveRate): self
    {
        $this->ibsMunicipalityRegularEffectiveRate = $ibsMunicipalityRegularEffectiveRate;
        return $this;
    }

    public function getIbsMunicipalityRegularTaxValue(): ?float
    {
        return $this->ibsMunicipalityRegularTaxValue;
    }

    public function setIbsMunicipalityRegularTaxValue(?float $ibsMunicipalityRegularTaxValue): self
    {
        $this->ibsMunicipalityRegularTaxValue = $ibsMunicipalityRegularTaxValue;
        return $this;
    }

    public function getCbsRegularEffectiveRate(): ?float
    {
        return $this->cbsRegularEffectiveRate;
    }

    public function setCbsRegularEffectiveRate(?float $cbsRegularEffectiveRate): self
    {
        $this->cbsRegularEffectiveRate = $cbsRegularEffectiveRate;
        return $this;
    }

    public function getCbsRegularTaxValue(): ?float
    {
        return $this->cbsRegularTaxValue;
    }

    public function setCbsRegularTaxValue(?float $cbsRegularTaxValue): self
    {
        $this->cbsRegularTaxValue = $cbsRegularTaxValue;
        return $this;
    }

    public function getPresumedCreditClassificationCode(): ?int
    {
        return $this->presumedCreditClassificationCode;
    }

    public function setPresumedCreditClassificationCode(?int $presumedCreditClassificationCode): self
    {
        $this->presumedCreditClassificationCode = $presumedCreditClassificationCode;
        return $this;
    }

    public function getIbsPresumedCreditPercentage(): ?float
    {
        return $this->ibsPresumedCreditPercentage;
    }

    public function setIbsPresumedCreditPercentage(?float $ibsPresumedCreditPercentage): self
    {
        $this->ibsPresumedCreditPercentage = $ibsPresumedCreditPercentage;
        return $this;
    }

    public function getIbsPresumedCreditValue(): ?float
    {
        return $this->ibsPresumedCreditValue;
    }

    public function setIbsPresumedCreditValue(?float $ibsPresumedCreditValue): self
    {
        $this->ibsPresumedCreditValue = $ibsPresumedCreditValue;
        return $this;
    }

    public function getIbsPresumedCreditSuspensiveConditionValue(): ?float
    {
        return $this->ibsPresumedCreditSuspensiveConditionValue;
    }

    public function setIbsPresumedCreditSuspensiveConditionValue(?float $ibsPresumedCreditSuspensiveConditionValue): self
    {
        $this->ibsPresumedCreditSuspensiveConditionValue = $ibsPresumedCreditSuspensiveConditionValue;
        return $this;
    }

    public function getCbsPresumedCreditPercentage(): ?float
    {
        return $this->cbsPresumedCreditPercentage;
    }

    public function setCbsPresumedCreditPercentage(?float $cbsPresumedCreditPercentage): self
    {
        $this->cbsPresumedCreditPercentage = $cbsPresumedCreditPercentage;
        return $this;
    }

    public function getCbsPresumedCreditValue(): ?float
    {
        return $this->cbsPresumedCreditValue;
    }

    public function setCbsPresumedCreditValue(?float $cbsPresumedCreditValue): self
    {
        $this->cbsPresumedCreditValue = $cbsPresumedCreditValue;
        return $this;
    }

    public function getCbsPresumedCreditSuspensiveConditionValue(): ?float
    {
        return $this->cbsPresumedCreditSuspensiveConditionValue;
    }

    public function setCbsPresumedCreditSuspensiveConditionValue(?float $cbsPresumedCreditSuspensiveConditionValue): self
    {
        $this->cbsPresumedCreditSuspensiveConditionValue = $cbsPresumedCreditSuspensiveConditionValue;
        return $this;
    }

    public function getPresumedCreditZfmCompetence(): ?string
    {
        return $this->presumedCreditZfmCompetence;
    }

    public function setPresumedCreditZfmCompetence(?string $presumedCreditZfmCompetence): self
    {
        $this->presumedCreditZfmCompetence = $presumedCreditZfmCompetence;
        return $this;
    }

    public function getPresumedCreditZfmClassification(): ?string
    {
        return $this->presumedCreditZfmClassification;
    }

    public function setPresumedCreditZfmClassification(?string $presumedCreditZfmClassification): self
    {
        $this->presumedCreditZfmClassification = $presumedCreditZfmClassification;
        return $this;
    }

    public function getPresumedCreditZfmValue(): ?float
    {
        return $this->presumedCreditZfmValue;
    }

    public function setPresumedCreditZfmValue(?float $presumedCreditZfmValue): self
    {
        $this->presumedCreditZfmValue = $presumedCreditZfmValue;
        return $this;
    }

    public function getMonoTaxedQuantityBase(): ?float
    {
        return $this->monoTaxedQuantityBase;
    }

    public function setMonoTaxedQuantityBase(?float $monoTaxedQuantityBase): self
    {
        $this->monoTaxedQuantityBase = $monoTaxedQuantityBase;
        return $this;
    }

    public function getMonoIbsAdRemRate(): ?float
    {
        return $this->monoIbsAdRemRate;
    }

    public function setMonoIbsAdRemRate(?float $monoIbsAdRemRate): self
    {
        $this->monoIbsAdRemRate = $monoIbsAdRemRate;
        return $this;
    }

    public function getMonoCbsAdRemRate(): ?float
    {
        return $this->monoCbsAdRemRate;
    }

    public function setMonoCbsAdRemRate(?float $monoCbsAdRemRate): self
    {
        $this->monoCbsAdRemRate = $monoCbsAdRemRate;
        return $this;
    }

    public function getMonoIbsValue(): ?float
    {
        return $this->monoIbsValue;
    }

    public function setMonoIbsValue(?float $monoIbsValue): self
    {
        $this->monoIbsValue = $monoIbsValue;
        return $this;
    }

    public function getMonoCbsValue(): ?float
    {
        return $this->monoCbsValue;
    }

    public function setMonoCbsValue(?float $monoCbsValue): self
    {
        $this->monoCbsValue = $monoCbsValue;
        return $this;
    }

    public function getMonoRetainedTaxedQuantityBase(): ?float
    {
        return $this->monoRetainedTaxedQuantityBase;
    }

    public function setMonoRetainedTaxedQuantityBase(?float $monoRetainedTaxedQuantityBase): self
    {
        $this->monoRetainedTaxedQuantityBase = $monoRetainedTaxedQuantityBase;
        return $this;
    }

    public function getMonoIbsRetentionRate(): ?float
    {
        return $this->monoIbsRetentionRate;
    }

    public function setMonoIbsRetentionRate(?float $monoIbsRetentionRate): self
    {
        $this->monoIbsRetentionRate = $monoIbsRetentionRate;
        return $this;
    }

    public function getMonoIbsRetentionValue(): ?float
    {
        return $this->monoIbsRetentionValue;
    }

    public function setMonoIbsRetentionValue(?float $monoIbsRetentionValue): self
    {
        $this->monoIbsRetentionValue = $monoIbsRetentionValue;
        return $this;
    }

    public function getMonoCbsRetentionRate(): ?float
    {
        return $this->monoCbsRetentionRate;
    }

    public function setMonoCbsRetentionRate(?float $monoCbsRetentionRate): self
    {
        $this->monoCbsRetentionRate = $monoCbsRetentionRate;
        return $this;
    }

    public function getMonoCbsRetentionValue(): ?float
    {
        return $this->monoCbsRetentionValue;
    }

    public function setMonoCbsRetentionValue(?float $monoCbsRetentionValue): self
    {
        $this->monoCbsRetentionValue = $monoCbsRetentionValue;
        return $this;
    }

    public function getMonoPreviouslyRetainedQuantityBase(): ?float
    {
        return $this->monoPreviouslyRetainedQuantityBase;
    }

    public function setMonoPreviouslyRetainedQuantityBase(?float $monoPreviouslyRetainedQuantityBase): self
    {
        $this->monoPreviouslyRetainedQuantityBase = $monoPreviouslyRetainedQuantityBase;
        return $this;
    }

    public function getMonoIbsPreviouslyRetainedRate(): ?float
    {
        return $this->monoIbsPreviouslyRetainedRate;
    }

    public function setMonoIbsPreviouslyRetainedRate(?float $monoIbsPreviouslyRetainedRate): self
    {
        $this->monoIbsPreviouslyRetainedRate = $monoIbsPreviouslyRetainedRate;
        return $this;
    }

    public function getMonoIbsPreviouslyRetainedValue(): ?float
    {
        return $this->monoIbsPreviouslyRetainedValue;
    }

    public function setMonoIbsPreviouslyRetainedValue(?float $monoIbsPreviouslyRetainedValue): self
    {
        $this->monoIbsPreviouslyRetainedValue = $monoIbsPreviouslyRetainedValue;
        return $this;
    }

    public function getMonoCbsPreviouslyRetainedRate(): ?float
    {
        return $this->monoCbsPreviouslyRetainedRate;
    }

    public function setMonoCbsPreviouslyRetainedRate(?float $monoCbsPreviouslyRetainedRate): self
    {
        $this->monoCbsPreviouslyRetainedRate = $monoCbsPreviouslyRetainedRate;
        return $this;
    }

    public function getMonoCbsPreviouslyRetainedValue(): ?float
    {
        return $this->monoCbsPreviouslyRetainedValue;
    }

    public function setMonoCbsPreviouslyRetainedValue(?float $monoCbsPreviouslyRetainedValue): self
    {
        $this->monoCbsPreviouslyRetainedValue = $monoCbsPreviouslyRetainedValue;
        return $this;
    }

    public function getMonoIbsDeferredPercentage(): ?float
    {
        return $this->monoIbsDeferredPercentage;
    }

    public function setMonoIbsDeferredPercentage(?float $monoIbsDeferredPercentage): self
    {
        $this->monoIbsDeferredPercentage = $monoIbsDeferredPercentage;
        return $this;
    }

    public function getMonoIbsDeferredValue(): ?float
    {
        return $this->monoIbsDeferredValue;
    }

    public function setMonoIbsDeferredValue(?float $monoIbsDeferredValue): self
    {
        $this->monoIbsDeferredValue = $monoIbsDeferredValue;
        return $this;
    }

    public function getMonoCbsDeferredPercentage(): ?float
    {
        return $this->monoCbsDeferredPercentage;
    }

    public function setMonoCbsDeferredPercentage(?float $monoCbsDeferredPercentage): self
    {
        $this->monoCbsDeferredPercentage = $monoCbsDeferredPercentage;
        return $this;
    }

    public function getMonoCbsDeferredValue(): ?float
    {
        return $this->monoCbsDeferredValue;
    }

    public function setMonoCbsDeferredValue(?float $monoCbsDeferredValue): self
    {
        $this->monoCbsDeferredValue = $monoCbsDeferredValue;
        return $this;
    }

    public function getMonoIbsTotalItem(): ?float
    {
        return $this->monoIbsTotalItem;
    }

    public function setMonoIbsTotalItem(?float $monoIbsTotalItem): self
    {
        $this->monoIbsTotalItem = $monoIbsTotalItem;
        return $this;
    }

    public function getMonoCbsTotalItem(): ?float
    {
        return $this->monoCbsTotalItem;
    }

    public function setMonoCbsTotalItem(?float $monoCbsTotalItem): self
    {
        $this->monoCbsTotalItem = $monoCbsTotalItem;
        return $this;
    }

    public function getIbsTransferredValue(): ?float
    {
        return $this->ibsTransferredValue;
    }

    public function setIbsTransferredValue(?float $ibsTransferredValue): self
    {
        $this->ibsTransferredValue = $ibsTransferredValue;
        return $this;
    }

    public function getCbsTransferredValue(): ?float
    {
        return $this->cbsTransferredValue;
    }

    public function setCbsTransferredValue(?float $cbsTransferredValue): self
    {
        $this->cbsTransferredValue = $cbsTransferredValue;
        return $this;
    }

    public function getAssessmentCompetenceDate(): ?string
    {
        return $this->assessmentCompetenceDate;
    }

    public function setAssessmentCompetenceDate(?string $assessmentCompetenceDate): self
    {
        $this->assessmentCompetenceDate = $assessmentCompetenceDate;
        return $this;
    }

    public function getIbsCompetenceAdjustmentAmount(): ?float
    {
        return $this->ibsCompetenceAdjustmentAmount;
    }

    public function setIbsCompetenceAdjustmentAmount(?float $ibsCompetenceAdjustmentAmount): self
    {
        $this->ibsCompetenceAdjustmentAmount = $ibsCompetenceAdjustmentAmount;
        return $this;
    }

    public function getCbsCompetenceAdjustmentAmount(): ?float
    {
        return $this->cbsCompetenceAdjustmentAmount;
    }

    public function setCbsCompetenceAdjustmentAmount(?float $cbsCompetenceAdjustmentAmount): self
    {
        $this->cbsCompetenceAdjustmentAmount = $cbsCompetenceAdjustmentAmount;
        return $this;
    }

    public function getFuelAnpCode(): ?string
    {
        return $this->fuelAnpCode;
    }

    public function setFuelAnpCode(?string $fuelAnpCode): self
    {
        $this->fuelAnpCode = $fuelAnpCode;
        return $this;
    }

    public function getFuelAnpDescription(): ?string
    {
        return $this->fuelAnpDescription;
    }

    public function setFuelAnpDescription(?string $fuelAnpDescription): self
    {
        $this->fuelAnpDescription = $fuelAnpDescription;
        return $this;
    }

    public function getFuelUf(): ?string
    {
        return $this->fuelUf;
    }

    public function setFuelUf(?string $fuelUf): self
    {
        $this->fuelUf = $fuelUf;
        return $this;
    }

    public function getTaxBenefitCode(): ?string
    {
        return $this->taxBenefitCode;
    }

    public function setTaxBenefitCode(?string $taxBenefitCode): self
    {
        $this->taxBenefitCode = $taxBenefitCode;
        return $this;
    }
}
